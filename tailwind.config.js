const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ["Nunito", ...defaultTheme.fontFamily.sans],
        poppins: ["Poppins"],
      },
      colors: {
        theme: "#4a46ff",
        lightblue: "#c6c5ff",
        lightgreen: "#60e69d",
        lightred: "#fe6850",
        lightsky: "#009cff",
        darkblue: "#7080b1",
      },
    },
  },

  plugins: [require("@tailwindcss/forms"), require("tailwind-scrollbar")],
  variants: {
    scrollbar: ["rounded"],
  },
};
