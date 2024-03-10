/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./views/**/*.php',
            './modules/**/views/**/*.php',
            './node_modules/tw-elements/dist/js/**/*.js',
            './node_modules/flowbite/**/*.js'
          ],
  theme: {
    extend: {
      colors: {
        "primary": "#3498db",
        "secondary": "#2ecc71",
        "neutral": "#f4f4f4",
        "custom-text": "#333333",
        "even": "#f9f9f9",
        "odd": "#ffffff",
        "table-text": "#333333"
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('flowbite/plugin')
    // ...
  ],
  darkMode: "class",
  corePlugins: {
    ringWidth: true,
    ringColor: true,
  },
}

