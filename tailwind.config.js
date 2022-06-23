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
    container: {
      center: true,
    },
    extend: {
      colors: {
        'dark-red': '#A4102B',
        'green': '#92d33a',
        'gray': colors.neutral,
        'black': colors.black,
        'whatsapp' : '#60C364',
        'orange' : '#FF8E0A',
      },
      fontFamily: {
        default: ['brandon-grotesque', 'sans-serif'],
      },
      minHeight: {
          '1/4': '25vh',
          '1/2': '50vh',
          '3/4': '75vh',
      },
      maxWidth: {
          '2/3': '66.66%',
      },
      letterSpacing: {
          'custom-wider':'0.08em',
      },
      aspectRatio: {
        '3/4': '3 / 4',
        'video-v': '9 / 16',
      },
      margin: {
        'full': '100%',
      },
    },
  },
  variants: {},
  plugins: [],
}
