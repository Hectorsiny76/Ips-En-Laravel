import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

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
            colors:{
                primary: {
                    50: '#ebfef6',
                    100: '#d0fbe7',
                    200: '#a4f6d4',
                    300: '#6aebbf',
                    400: '#2fd8a3',
                    500: '#0abf8c',
                    600: '#009b73',
                    700: '#008163',
                    800: '#03624c',
                    900: '#045040',
                    950: '#012d25',
                },
                secondary: {
                    50: '#fff8ed',
                    100: '#feefd6',
                    200: '#fcdbac',
                    300: '#fac177',
                    400: '#f79c40',
                    500: '#f4811f',
                    600: '#e56411',
                    700: '#be4b10',
                    800: '#973c15',
                    900: '#7a3314',
                    950: '#421708',
                },
                terciary: {
                    50: '#fff1f1',
                    100: '#ffdfdf',
                    200: '#ffc5c5',
                    300: '#ff9d9d',
                    400: '#ff6566',
                    500: '#ff3435',
                    600: '#ee2526',
                    700: '#c70e0f',
                    800: '#a50f10',
                    900: '#881415',
                    950: '#4a0505',
                }
            }
        },
    },

    plugins: [forms],
};
