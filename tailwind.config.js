module.exports = {
    darkMode: 'class',
    content: [
        './app/**/*.html',
        './app/controllers/user/theme/*.php',
        './images/templates/templates.js',
        './docs/*.html',
        './js/fftable.min.js',
        './js-src/fftable.js'
    ],
    plugins: [
        require('flowbite/plugin'),
        require('flowbite-typography'),
        require("tailwindcss-animate"),
    ],
    theme: {
        extend: {
            colors: {
                theme: {
                    light: "white",
                    dark: "black",
                    background1: "#FAFAFA", // gray 50
                    darkBackground1: "#18181B", // gray 900
                    background2: "#E5E5E5", // gray 200
                    darkBackground2: "#3F3F46", // gray 700
                    background3: "#A3A3A3", // gray 400
                    darkBackground3: "#71717A", // gray 500
                    text1: "black",
                    darkText1: "white",
                    text2: "#E7E5E4", // slate 200
                    darkText2: "#44403C", // slate 700,
                    text3: "#78716C", // slate 500
                    darkText3: "#A8A29E", // slate 400
                    inputText: "#0F172A", // slate 900,
                    darkInputText: "#F8FAFC", // slate 50
                    inputBackground: "#f8fafc", // slate 50
                    darkInputBackground: "#0f172a", // slate 900
                    tableHeader: "#f9fafb", // gray 50
                    darkTableHeader: "#111827", // gray 900
                    tableHeaderText: "#111827", // gray 900
                    darkTableHeaderText: "#f9fafb", // gray 50
                    tableRow: "white", // stone 100
                    darkTableRow: "black", // stone 800
                    tableSelectedRow: "#E7E5E4", // stone 200
                    darkTableSelectedRow: "#44403C", // stone 700
                    tableRowText: "#9ca3af", // gray 400
                    darkTableRowText: "#6b7280", // gray 500
                    border1: "#D4D4D8", // gray 300 
                    border2: "#71717A", // gray 500
                    border3: "#3F3F46", // gray 700
                    focus: "#3B82F6", // blue 500
                    error: "#EF4444", // red 500
                    darkError: "#F87171", // red 400
                },
            },
        },
    },

}