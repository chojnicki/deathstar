module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    'airbnb-base',
    'plugin:vue/vue3-recommended',
    '@vue/typescript/recommended',
  ],
  rules: {
    semi: [2, 'never'], // remove unnecessary semicolons at end of line
    '@typescript-eslint/no-unused-vars': 'off', // temporary fix for new <script setup> syntax
    'import/no-extraneous-dependencies': 'off', // do not force moving packages from dev depedencies to depedencies
    'import/extensions': ['error', 'ignorePackages', { js: 'never', ts: 'never' }], // airbnb rule conflicts with ts
    'import/prefer-default-export': 'off', // better treeshaking and easier code refactoring
    '@typescript-eslint/explicit-module-boundary-types': 'off', // composition stores, return type based on its content
    'no-await-in-loop': 'off', // no reason to not use await in loop when we need promises sequential
  },
  settings: {
    'import/resolver': {
      typescript: {}, // make @ alias to work in eslint
    },
  },
}
