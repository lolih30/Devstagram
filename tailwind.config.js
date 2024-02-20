/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.blade.js", 
    "./vendor/laravel/framework/src/Illuminate/pagination/resources/views/*.blade.php", 

],
  theme: {
    extend: {},
  },
  plugins: [],
}

