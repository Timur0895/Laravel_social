module.exports = {
  darkMode: "class",
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    container: {
      center: true,
      padding: '5rem',
    },
    extend: {
      colors: {
        'oranges': 'linear-gradient(to right, #ffb347, #ffcc33)',
      },
    }
  },
  plugins: [
  ],
}
