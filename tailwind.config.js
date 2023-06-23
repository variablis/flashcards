import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Noto Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],

    darkMode: 'class',

    safelist: [
        'text-2xl',
        'text-3xl',
        {
          pattern: /(from|to|via)-(rose|emerald|blue)-(500|600|700|800)/,
        },
      ],

};
