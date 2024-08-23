/** @type {import('tailwindcss').Config} */

// const colors = require('tailwindcss/colors')
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./app/**/*.php",
        "./config/**/*.php",
        "./resources/**/*.{php,js}",
        "./storage/framework/views/*.php",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#eff6ff",
                    100: "#dbeafe",
                    200: "#bfdbfe",
                    300: "#93c5fd",
                    400: "#60a5fa",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                    900: "#1e3a8a",
                },
            },
            screens: {
                xs: "475px",
                ...defaultTheme.screens,
            },
        },
    },
    plugins: [require("flowbite/plugin"), require("flowbite-typography"), require('@tailwindcss/aspect-ratio'),],
};
