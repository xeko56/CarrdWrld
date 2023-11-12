/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./views/**/*.php',
            './modules/**/views/**/*.php'],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    // ...
  ],
  corePlugins: {
    ringWidth: true,
    ringColor: true,
  },
}

