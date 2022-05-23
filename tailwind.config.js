const colors = require('tailwindcss/colors');

module.exports = {
  content: ["./resources/js/**/*.js", "./resources/js/**/*.vue"],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      emerald: colors.emerald,
      indigo: colors.indigo,
      yellow: colors.yellow,
    },
    extend: {
      colors: {
        'dark-red': '#A4102B',
      },
      fontFamily: {
        sans: ['Graphik', 'sans-serif'],
      },
    },
  },
  variants: {},
  plugins: [],
}
