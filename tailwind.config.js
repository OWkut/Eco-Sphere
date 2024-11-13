/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php", // inclut les fichiers PHP à la racine
    "./**/*.php", // inclut les fichiers PHP dans les sous-dossiers
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}