export function componentArticles() {
    Alpine.data('loadMoreArticles', (maxNumPages = 1) => ({
        currentPage: 1,

        loadMore() {
            let formData = new FormData();
            formData.append('action', 'load_more_posts');
            formData.append('currentPage', this.currentPage)

            fetch(site_objects.ajax_url, {
                method: "POST",
                body: formData
            })
                .then((res) => res.json())
                .then((res) => {
                    if (!res.success) return

                    this.$refs.articleGrid.innerHTML += res.data.html
                    this.currentPage = res.data.currentPage

                    if(this.currentPage >= maxNumPages){
                        this.$el.setAttribute('disabled', true)
                    }
                })
        }
    }))
}