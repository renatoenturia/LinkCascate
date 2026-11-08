import daisyui from 'daisyui';

/**
 * Tailwind v4 ainda aceita tailwind.config.js via @config no app.css.
 * Equivalente ao comando legado: npx tailwindcss init
 *
 * @type {import('tailwindcss').Config}
 */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [daisyui],
    daisyui: {
        themes: ['light', 'dark', 'corporate'],
        darkTheme: 'dark',
        logs: false,
    },
};
