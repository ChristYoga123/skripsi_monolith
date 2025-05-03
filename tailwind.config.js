import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'selector',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins"],
                "h5-font-family": "Poppins-SemiBold, sans-serif",
                "b-sb-dekstop-font-family": "Poppins-SemiBold, sans-serif",
                "h5-bold-font-family": "Poppins-SemiBold, sans-serif",
                "h3-bold-font-family": "Poppins-SemiBold, sans-serif",
                "body-dekstop-regular-font-family": "Poppins-Regular, sans-serif",
                "h5-regular-font-family": "Poppins-Regular, sans-serif",
            },
            fontSize: {
                h1: [
                    "64px",
                    {
                        lineHeight: "80px",
                        fontWeight: "600",
                    },
                ],
                h2: [
                    "48px",
                    {
                        lineHeight: "64px",
                        fontWeight: "600",
                    },
                ],
                h3: [
                    "32px",
                    {
                        lineHeight: "42px",
                        fontWeight: "600",
                    },
                ],
                h4: [
                    "24px",
                    {
                        lineHeight: "32px",
                        fontWeight: "600",
                    },
                ],
                h5: [
                    "18px",
                    {
                        lineHeight: "26px",
                        fontWeight: "600",
                    },
                ],
                "body-dekstop": [
                    "15px",
                    {
                        lineHeight: "24px",
                        fontWeight: "400",
                    },
                ],
                "body-sm-dekstop": [
                    "15px",
                    {
                        lineHeight: "24px",
                        fontWeight: "600",
                    },
                ],
                "body-mobile": [
                    "10px",
                    {
                        lineHeight: "20px",
                        fontWeight: "400",
                    },
                ],
                "body-sm-mobile": [
                    "10px",
                    {
                        lineHeight: "20px",
                        fontWeight: "600",
                    },
                ],
                "h5-font-size": "18px",
                "b-sb-dekstop-font-size": "15px",
                "h5-bold-font-size": "18px",
                "h3-bold-font-size": "32px",
                "body-dekstop-regular-font-size": "16px",
                "h5-regular-font-size": "18px",
            },
            fontWeight: {
                "h5-font-weight": "600",
                "b-sb-dekstop-font-weight": "600",
                "h5-bold-font-weight": "600",
                "h3-bold-font-weight": "600",
                "body-dekstop-regular-font-weight": "400",
                "h5-regular-font-weight": "400",
            },
            lineHeight: {
                "h5-line-height": "26px",
                "b-sb-dekstop-line-height": "24px",
                "h5-bold-line-height": "48px",
                "h3-bold-line-height": "48px",
                "body-dekstop-regular-line-height": "28px",
                "h5-regular-line-height": "48px",
            },
            letterSpacing: {},
            borderRadius: {},
            colors: {
                primary: {
                    "green-base": "#2DCC70",
                    "green-light": "#C5FFDD",
                },
                secondary: {
                    "yellow-base": "#FFCF3D",
                    "yellow-light": "#FFF7DE",
                },
                alert: {
                    success: "#2DCC70",
                    warning: "#FFCF3D",
                    error: "#DA2727",
                },
                neutrals: {
                    "dark-01": "#27272F",
                    "dark-02": "#94949C",
                    "light-01": "#FFFFFF",
                    "light-02": "#CFCFD4",
                },
                "green-base": "#2dcc70",
                "dark-02": "#94949c",
                "light-01": "#ffffff",
                "text-dark": "#27272f",
                "primary-green-base": "#2dcc70",
                "text-light": "#ffffff",
                "primary-green-light": "#c5ffdd",
                "text-gray": "#94949c",
                "text-light-02": "#cfcfd4",
                success: "#2dcc70",
                "neutral-100": "#ffffff",
                "neutral-600": "#6f6c90",
                green: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
            },
        },
    },
    plugins: [
        function({ addUtilities }) {
            const newUtilities = {
                ".bg-image-card": {
                    backgroundImage: 'url("assets/cp/bg-card1.png")',
                    backgroundSize: "cover",
                    backgroundPosition: "center",
                },
            };
            addUtilities(newUtilities);
        },
    ],
};