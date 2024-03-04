import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',

  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    screens: {
      min: '320px',
      xs: '480px',
      sm: '640px',
      md: '768px',
      lg: '992px',
      xl: '1440px',
      xxl: '1920px',
      max: '2560px',
    },

    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [forms],

  safelist: [
    {
      pattern: /ml-8|list-disc/,
    },
  ],
}
