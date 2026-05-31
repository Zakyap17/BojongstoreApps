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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#146c2e',    // Main dark green
                secondary: '#105e26',  // Darker green
                accent: '#9ad2a7',     // Mint green
                surface: '#f1f6f1',    // Cream/light background
            }
        },
    },

    plugins: [forms],
};
