module.exports = {
    useTabs: true,
    tabWidth: 2,
    printWidth: 40,
    singleQuote: true,
    trailingComma: es5,
    bracketSpacing: true,
    parenSpacing: true,
    jsxBracketSameLine: false,
    semi: true,
    arrowParens: avoid,
    plugins: [
        require("@prettier/plugin-php"),
        require("prettier-plugin-tailwindcss")
    ],
};
