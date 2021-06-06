/* Ported from SASS to JS (postcss functions plugin) from http://codepen.io/saransh/pen/BKJun */
const generateStars = (count) => {
  let value = ''
  // eslint-disable-next-line no-plusplus
  for (let i = 0; i < count; i++) {
    const randX = Math.floor(Math.random() * 2000)
    const randY = Math.floor(Math.random() * 2000)
    value += `${randX}px ${randY}px #fff,`
  }
  value = value.slice(0, -1) // remove last ','
  return value
}

module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
    'postcss-nested': {},
    'postcss-import': {},
    'postcss-functions': {
      functions: { generateStars },
    },
  },
}
