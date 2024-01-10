/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
const plugin = require('tailwindcss/plugin');

const theme = require('./theme.json');
const tailpress = require("@jeffreyvr/tailwindcss-tailpress");

const folders = ["./blocks/**/*.php", "./partials/**/*.php", "./functions/**/*.php", "./page-template-lesson.php", "./user-templates/**/*.php", "safelist.txt"];

const purse_files = folders.concat(findFileByExt());

module.exports = {
    content: purse_files,
    theme: {
        extend: {
            colors: tailpress.colorMapper(tailpress.theme('settings.color.palette', theme)),
            spacing: {
                "1/5": "20%",
            },
            height: {
                "1/6": "16.66667dvh",
                "1/4": "25dvh",
                "1/2": "50dvh",
                "1/3": "33.33333dvh",
                "5/6": "83.33333dvh",
                "1/1": "100dvh",
            },
            maxHeight: {
                "1/6": "16.66667dvh",
                "1/4": "25dvh",
                "1/3": "33.33333dvh",
                "1/2": "50dvh",
                "5/6": "83.33333dvh",
                "1/1": "100dvh",
            },
            minHeight: {
                "1/6": "16.66667dvh",
                "1/4": "25dvh",
                "1/3": "33.33333dvh",
                "1/2": "50dvh",
                "5/6": "83.33333dvh",
                "1/1": "100dvh",
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
                header: ["Nexa", ...defaultTheme.fontFamily.sans],
            },
            fontSize : {
                '2xs' : '0.5rem'
            },
            letterSpacing: {
                'full': '0.2rem'
            },
            transitionDuration: {
                450: "450ms",
            },
            zIndex: {
                9999: 9999
            },
            keyframes: {
                rasmusp: {
                    "0%, 100%": { color: "#40d4d3" },
                    "50%": { color: "#9548d6" },
                },
            },
            animation: {
                rasmusp: "rasmusp 4s 0ms linear infinite",
            },
            typography: ({theme}) => ({
                DEFAULT: {
                    css: {
                        lineHeight: '1.425rem',
                        h1: {
                            fontSize: '1.802rem',
                            lineHeight: '2.116rem',
                            fontWeight: '700'
                        },
                        h2: {
                            fontSize: '1.602rem',
                            lineHeight: '1.931rem',
                            fontWeight: '700',
                        },
                        h3: {
                            fontSize: '1.424rem',
                            lineHeight: '1.794rem',
                            fontWeight: '700',
                        },
                        h4: {
                            fontSize: '1.266rem',
                            lineHeight: '1.486rem',
                            fontWeight: '700',
                        },
                        h5: {
                            fontSize: '1.125rem',
                            lineHeight: '1.321rem',
                            fontWeight: '700'
                        },
                        ul: {
                            paddingLeft: '1rem',

                            li: {

                                '&::marker': {
                                    content: '"•"'
                                }
                            }
                        },
                        a: {
                            fontWeight: '700',
                            textUnderlineOffset: '2px',
                            '&:focus-visible': {
                                outlineOffset: '2px',
                                textDecoration: 'none'
                            },
                        }
                    }
                },
                lg: {
                    css: {
                        lineHeight: '26px',
                        fontSize: '18px',
                        h1: {
                            fontSize: '32.44px',
                            lineHeight: '38.08px',
                            fontWeight: '700'
                        },
                        h2: {
                            fontSize: '28.83px',
                            lineHeight: '33.85px',
                            fontWeight: '700',
                        },
                        h3: {
                            fontSize: '25.63px',
                            lineHeight: '30.09px',
                            fontWeight: '700',
                        },
                        h4: {
                            fontSize: '22.78px',
                            lineHeight: '26.74',
                            fontWeight: '700',
                        },
                        h5: {
                            fontSize: '18px',
                            lineHeight: '23.77px',
                            fontWeight: '700'
                        },
                        ul: {
                            paddingLeft: '1rem',

                            li: {

                                '&::marker': {
                                    content: '"•"'
                                }
                            }
                        },
                        a: {
                            fontWeight: '700',
                            textUnderlineOffset: '2px',
                            '&:focus-visible': {
                                outlineOffset: '2px',
                                textDecoration: 'none'
                            },
                        }
                    }
                }
            }),
            textFillColor: (theme) => theme("borderColor"),
            textStrokeColor: (theme) => theme("borderColor"),
            textStrokeWidth: (theme) => theme("borderWidth"),
            paintOrder: {
                fsm: { paintOrder: "fill stroke markers" },
                fms: { paintOrder: "fill markers stroke" },
                sfm: { paintOrder: "stroke fill markers" },
                smf: { paintOrder: "stroke markers fill" },
                mfs: { paintOrder: "markers fill stroke" },
                msf: { paintOrder: "markers stroke fill" },
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"),
        require("tailwindcss-text-fill-stroke")(),
        tailpress.tailwind,
        plugin(function({ addVariant }) {
            addVariant('hocus', ['&:hover', '&:focus-visible'])
        })
    ],
};

function findFileByExt() {
    const fs = require("fs");
    const path = require("path");

    const fullPath = path.resolve(__dirname);

    var files = fs.readdirSync(fullPath);

    return files.filter((file) => {
        return path.extname(file) === ".php";
    });
}
