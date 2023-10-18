/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './public/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: "#751d4f",
                "primary-light": "#cc338a",
                accent: "#bf995c",
            },
            transitionProperty: {
                'left': 'left',
                'top': 'top'
            },
            maxHeight: {
                '100': 'calc(100vh - 8rem)',
            },
            minWidth: {
                '100': 'calc(100% - 260px)'
            }
        },
    },
    plugins: [],
}