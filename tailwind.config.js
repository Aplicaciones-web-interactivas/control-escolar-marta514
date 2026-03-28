import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'azul-marino': '#2f3a55',
        'azul-claro': '#5c6b8a',
        'gris-escolar': '#6e6f73',
        'cafe-acento': '#9f9b75',
        'blanco-fondo': '#f5f6f3',
      },
    },
  },
  plugins: [],
}
