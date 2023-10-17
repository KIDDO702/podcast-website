/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            nunito: ['Nunito Sans', 'sans-serif'],
            poppins: ['Poppins', 'sans-serif']
        },

        container: {
            center: true
        },


    },
  },
  plugins: [],
}
