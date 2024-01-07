import {trackEvent} from "../utils/plausible";

export function BlockAudio() {
    Alpine.magic('media_session', () => {
        return navigator.mediaSession;
    })

    Alpine.data('audioPlayer', () => ({
        playing: false,
        muted: false,
        ended: false,
        duration: 0,
        timeDurationString: '00:00',
        timeElapsedString: '00:00',
        PlayerReady: false,
        defaultSkipTime: 10,

        init() {
            this.$refs.player.load();

            if (this.$media_session.playbackState != 'none') {
                this.$media_session.setActionHandler('play', this.togglePlay());
                this.$media_session.setActionHandler('pause', this.togglePlay());
                this.$media_session.setActionHandler('seekbackward', this.seekBackward);
                this.$media_session.setActionHandler('seekforward', this.seekForward);
                this.$meida_session.setActionHandler('seekto', this.seekTo);
            }

            this.$refs.player.onplay = () => {
                this.playing = true;
            }

            this.$refs.player.onpause = () => {
                this.playing = false;
            }

            this.plausible();
        },


        metaDataLoaded(event) {
            this.audioDuration = event.target.duration;
            this.$refs.audioProgress.setAttribute('max', this.audioDuration);

            let time = this.formatTime(Math.round(this.audioDuration));
            this.timeDurationString = `${time.minutes}:${time.seconds}`;
            this.showTime = true;

            this.updateAudioMetaData();
        },

        togglePlay() {
            if (this.$refs.player.paused || this.$refs.player.ended) {
                //this.playing = true;
                this.$refs.player.play().then(_ => {
                    this.updateAudioMetaData()
                    this.$media_session.playbackState = 'playing'
                })
                    .catch(
                        error => console.log(error)
                    );
            } else {
                // this.playing = false;
                this.$refs.player.pause();
                this.$media_session.playbackState = 'paused'
            }
        },

        disableSpaceScroll() {
            return false;
        },

        toggleMute() {
            this.muted = !this.muted;
            this.$refs.player.muted = this.muted;
            if (this.muted) {
                this.volumeBeforeMute = this.volume;
                this.volume = 0;
            } else {
                this.volume = this.volumeBeforeMute;
            }
        },

        timeUpdatedInterval() {
            if (!this.$refs.audioProgress.getAttribute('max'))
                this.$refs.audioProgress.setAttribute('max', $refs.player.duration);
            this.$refs.audioProgress.value = this.$refs.player.currentTime;

            let time = this.formatTime(Math.round(this.$refs.player.currentTime));
            this.timeElapsedString = `${time.minutes}:${time.seconds}`;

            let progess_is_procent = (this.$refs.player.duration == null || isNaN(this.$refs.player.duration)) ? '0%' : ((100 / this.$refs.player.duration) * this.$refs.player.currentTime) + '%';
            this.$refs.audioProgress.setAttribute('style', '--progress-length: ' + progess_is_procent);
        },

        timelineSeek(e) {
            let time = this.formatTime(Math.round(e.target.value));
            this.timeElapsedString = `${time.minutes}:${time.seconds}`;
        },

        timelineClicked(e) {
            let rect = this.$refs.audioProgress.getBoundingClientRect();
            let pos = (e.pageX - rect.left) / this.$refs.audioProgress.offsetWidth;
            this.$refs.player.currentTime = pos * this.$refs.player.duration;
        },

        formatTime(timeInSeconds) {
            let result = new Date(timeInSeconds * 1000).toISOString().substr(11, 8);

            return {
                minutes: result.substr(3, 2),
                seconds: result.substr(6, 2),
            };
        },

        updateAudioMetaData() {
            this.$media_session.metadata = new MediaMetadata({
                src: this.$refs.player.src,
                title: this.$refs.player.dataset.title,
                artist: this.$refs.player.dataset.artist,
                album: this.$refs.player.dataset.album,
                artwork: [
                    { src: this.$refs.player.dataset.artwork },
                ]
            })

            this.updatePosition();
        },

        updatePosition() {
            if ('setPositionState' in this.$media_session) {
                this.$media_session.setPositionState({
                    duration: this.$refs.player.duration,
                    playbackRate: this.$refs.player.playbackRate,
                    position: this.$refs.player.currentTime
                });
            }
        },

        seekForward(event) {
            const skipTime = event.seekOffset || this.defaultSkipTime;
            console.log(skipTime);
            this.$refs.player.currentTime = Math.min(this.$refs.player.currentTime + skipTime, this.$refs.player.duration)

            this.updatePosition();
        },

        seekBackward(event) {
            const skipTime = event.seekOffset || this.defaultSkipTime;
            console.log(skipTime);
            this.$refs.player.currentTime = Math.max(this.$refs.player.currentTime - skipTime, 0)
            console.log(this.$refs.player.currentTime)
            this.updatePosition();
        },

        seekTo(event) {
            if (event.fastSeek && ('fastSeek' in this.$refs.player)) {
                this.$refs.player.fastSeek(event.seekTime);
                return;
            }

            this.$refs.player.currentTime = event.seekTime;
            this.updatePosition()
        },

        plausible() {
            let previousProgressPercentage = 0,
                executeEvents = [10, 50, 90],
                plausible_course = this.$refs.player.getAttribute('data-plausible-course'),
                plausible_module = this.$refs.player.getAttribute('data-plausible-module'),
                plausible_lesson = this.$refs.player.getAttribute('data-plausible-lesson');

            this.$refs.player.ontimeupdate = () => {
                let progressPercentage = Math.floor((100 / this.$refs.player.duration) * this.$refs.player.currentTime);

                if (progressPercentage >= previousProgressPercentage + 10 && executeEvents.includes(progressPercentage)) {

                    trackEvent('Audio', {
                        props: {
                            type: this.$refs.player.dataset.plausibleType,
                            title: this.$refs.player.dataset.plausibleTitle,
                            course: plausible_course,
                            module: plausible_module,
                            lesson: plausible_lesson,
                            completion: progressPercentage + '%',
                            sourceURL: this.$refs.player.src,
                        }
                    })

                    previousProgressPercentage = progressPercentage
                }
            }

            this.$refs.player.onended = () =>  {
                trackEvent('Audio', {
                    props: {
                        type: this.$refs.player.dataset.plausibleType,
                        title: this.$refs.player.dataset.plausibleTitle,
                        course: plausible_course,
                        module: plausible_module,
                        lesson: plausible_lesson,
                        completion: '100%',
                        sourceURL: this.$refs.player.src,
                    }
                })
            }
        }

    }))
}

function getTimeCodeFromNum(num) {
    let seconds = parseInt(num);
    let minutes = parseInt(seconds / 60);
    seconds -= minutes * 60;
    const hours = parseInt(minutes / 60);
    minutes -= hours * 60;

    if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
    return `${String(hours).padStart(2, 0)}:${minutes}:${String(
        seconds % 60
    ).padStart(2, 0)}`;
}

