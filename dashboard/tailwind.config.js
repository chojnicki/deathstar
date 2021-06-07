/* eslint-disable @typescript-eslint/no-var-requires */
const pluginForms = require('@tailwindcss/forms')
const plugin = require('tailwindcss/plugin')
const _ = require('lodash')

module.exports = {
  mode: 'jit',
  purge: ['./index.html', './vite.config.ts', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false,
  theme: {
    fontFamily: {
      sans: ['"Open Sans"', 'sans-serif'],
    },
    colors: {
      transparent: 'transparent',
      white: '#fff',
      black: '#000',
      red: '#ed193f',
      green: '#65A30D',
      yellow: '#EAB308',
      blue: {
        light: '#393a56',
        DEFAULT: '#292848',
        dark: '#0f0c21',
      },
    },
    extend: {
      screens: {
        sm: '480px',
      },
      borderColor: {
        DEFAULT: 'rgba(255, 255, 255, var(--tw-border-opacity));',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    pluginForms({
      strategy: 'class',
    }),
    /* Lightsaber glow */
    plugin(({ addUtilities, theme }) => {
      addUtilities({
        '.glow': {
          boxShadow: `0 0 10px ${theme('colors.red')},  0 0 10px ${theme('colors.red')} inset`,
        },
      })
    }),
    /* Table border spacing */
    plugin(({ addUtilities, theme, e }) => {
      addUtilities(_.map(theme('spacing'), (value, key) => ({
        [`.${e(`border-spacing-${key}`)}`]: {
          borderSpacing: value,
        },
        [`.${e(`border-spacing-x-${key}`)}`]: {
          borderSpacing: `${value} 0`,
        },
        [`.${e(`border-spacing-y-${key}`)}`]: {
          borderSpacing: `0 ${value}`,
        },
      })))
    }),
  ],
}
