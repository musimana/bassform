module.exports = {
  env: {
    browser: true,
    es2021: true,
    node: true,
  },
  extends: [
    'plugin:promise/recommended',
    'plugin:vue/vue3-essential',
  ],
  overrides: [
    {
      files: [
        '*AppForm.vue',
        '*FormInput.vue',
        '*InputTextarea.vue',
        '*NavbarHamburger.vue',
      ],
      rules: {
        'vue/no-textarea-mustache': 'off',
        'vue/no-mutating-props': 'off',
        'vue/no-use-v-if-with-v-for': 'off',
        'vue/require-v-for-key': 'off',
      },
    },
  ],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  plugins: [
    'vue',
  ],
  rules: {
    'array-bracket-newline': [
      'error',
      'consistent',
    ],
    'array-bracket-spacing': [
      'error',
      'never',
    ],
    'array-element-newline': [
      'error',
      'consistent',
    ],
    'arrow-spacing': [
      'error',
      {
        before: true,
        after: true,
      },
    ],
    'block-spacing': [
      'error',
      'always',
    ],
    'block-scoped-var': 'error',
    'brace-style': [
      'error',
      '1tbs',
    ],
    'comma-dangle': [
      'error',
      'always-multiline',
    ],
    'comma-spacing': [
      'error',
      {
        before: false,
        after: true,
      },
    ],
    'comma-style': [
      'error',
      'last',
    ],
    'computed-property-spacing': [
      'error',
      'never',
    ],
    'consistent-this': [
      'error',
      'vm',
    ],
    curly: [
      'error',
      'all',
    ],
    complexity: [
      'error',
      20,
    ],
    'dot-location': [
      'error',
      'property',
    ],
    'default-case-last': 'error',
    'default-param-last': 'error',
    'eol-last': [
      'error',
      'always',
    ],
    'eqeqeq': 'error',
    'func-call-spacing': [
      'error',
      'never',
    ],
    'function-call-argument-newline': [
      'error',
      'consistent',
    ],
    'function-paren-newline': [
      'error',
      'consistent',
    ],
    'generator-star-spacing': 'error',
    indent: [
      'error',
      2,
    ],
    'key-spacing': [
      'error',
      {
        beforeColon: false,
        afterColon: true,
        mode: 'strict',
      },
    ],
    'keyword-spacing': [
      'error',
      {
        after: true,
        before: true,
      },
    ],
    'lines-between-class-members': [
      'error',
      'always',
    ],
    'logical-assignment-operators': [
      'error',
      'always',
    ],
    'max-classes-per-file': 'error',
    'max-depth': [
      'error',
      4,
    ],
    'max-lines': [
      'error',
      1000,
    ],
    'max-lines-per-function': [
      'error',
      100,
    ],
    'max-nested-callbacks': [
      'error',
      3,
    ],
    'max-params': [
      'error',
      5,
    ],
    'max-statements': [
      'error',
      10,
    ],
    'max-statements-per-line': [
      'error',
      { max: 1 },
    ],
    'multiline-ternary': [
      'error',
      'always-multiline',
    ],
    'newline-per-chained-call': [
      'error',
      { ignoreChainWithDepth: 2 },
    ],
    'newline-after-var': [
      'error',
      'always',
    ],
    'newline-before-return': 'error',
    'new-cap': [
      'error',
      { newIsCapExceptionPattern: '^Form\\..' },
    ],
    'no-array-constructor': 'error',
    'no-alert': 'error',
    'no-constructor-return': 'error',
    'no-constant-binary-expression': 'error',
    'no-duplicate-imports': 'error',
    'no-div-regex': 'error',
    'no-else-return': 'error',
    'no-empty-function': 'error',
    'no-extra-semi': 'error',
    'no-extra-parens': 'error',
    'no-invalid-this': 'error',
    'no-lone-blocks': 'error',
    'no-lonely-if': 'error',
    'no-multi-spaces': 'error',
    'no-multiple-empty-lines': [
      'error',
      {
        max: 1,
        maxEOF: 0,
      },
    ],
    'no-tabs': 'error',
    'no-trailing-spaces': 'error',
    'no-unreachable-loop': 'error',
    'no-unused-private-class-members': 'error',
    'no-unused-expressions': 'error',
    'no-use-before-define': 'error',
    'no-useless-concat': 'error',
    'no-useless-constructor': 'error',
    'no-useless-rename': 'error',
    'no-useless-return': 'error',
    'no-var': 'error',
    'no-whitespace-before-property': 'error',
    'object-curly-newline': [
      'error',
      { consistent: true },
    ],
    'object-curly-spacing': [
      'error',
      'always',
    ],
    'object-property-newline': [
      'error',
      { allowAllPropertiesOnSameLine: true },
    ],
    'operator-assignment': [
      'error',
      'always',
    ],
    'operator-linebreak': [
      'error',
      'before',
    ],
    'padded-blocks': [
      'error',
      'never',
    ],
    'padding-line-between-statements': [
      'error',
      { blankLine: 'always', prev: 'directive', next: '*' },
      { blankLine: 'any', prev: 'directive', next: 'directive' },
    ],
    'prefer-arrow-callback': 'error',
    'prefer-const': 'error',
    'prefer-exponentiation-operator': 'error',
    'prefer-named-capture-group': 'error',
    'prefer-promise-reject-errors': 'error',
    quotes: [
      'error',
      'single',
    ],
    'require-atomic-updates': 'error',
    'require-await': 'error',
    semi: [
      'error',
      'never',
    ],
    'semi-style': [
      'error',
      'last',
    ],
    'semi-spacing': [
      'error',
      {
        before: false,
        after: true,
      },
    ],
    'space-before-blocks': [
      'error',
      'always',
    ],
    'space-before-function-paren': [
      'error',
      'never',
    ],
    'space-in-parens': [
      'error',
      'never',
    ],
    'space-infix-ops': 'error',
    'space-unary-ops': 'error',
    'switch-colon-spacing': [
      'error',
      {
        before: false,
        after: true,
      },
    ],
    'template-curly-spacing': [
      'error',
      'never',
    ],
    'template-tag-spacing': [
      'error',
      'always',
    ],
    yoda: 'error',
  },
}
