/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'selector',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // fontFamily: {
      //   'Arial': ['Arial', '"Helvetica Neue"', 'Helvetica', 'sans-serif'],
      //   'Baskerville': ['Baskerville', '"Baskerville Old Face"', 'Garamond', '"Times New Roman"', 'serif'],
      //   'Bodoni MT': ['"Bodoni MT"', '"Bodoni 72"', 'Didot', '"Didot LT STD"', '"Hoefler Text"', 'Garamond', '"Times New Roman"', 'serif'],
      //   'Calibri': ['Calibri', 'Candara', 'Segoe', '"Segoe UI"', 'Optima', 'Arial', 'sans-serif'],
      //   'Calisto MT': ['"Calisto MT"', '"Bookman Old Style"', 'Bookman', '"Goudy Old Style"', 'Garamond', '"Hoefler Text"', '"Bitstream Charter"', 'Georgia', 'serif'],
      //   'Cambria': ['Cambria', 'Georgia', 'serif'],
      //   'Candara': ['Candara', 'Calibri', 'Segoe', '"Segoe UI"', 'Optima', 'Arial', 'sans-serif'],
      //   'Century Gothic': ['"Century Gothic"', 'CenturyGothic', 'AppleGothic', 'sans-serif'],
      //   'Consolas': ['Consolas', 'monaco', 'monospace'],
      //   'Copperplate': ['Copperplate', 'Copperplate Gothic Light', 'fantasy'],
      //   'Courier New': ['"Courier New"', 'Courier', '"Lucida Sans Typewriter"', '"Lucida Typewriter"', 'monospace'],
      //   'Dejavu Sans': ['"Dejavu Sans"', 'Arial', 'Verdana', 'sans-serif'],
      //   'Didot': ['Didot', '"Didot LT STD"', '"Hoefler Text"', 'Garamond', '"Calisto MT"', '"Times New Roman"', 'serif'],
      //   'Franklin Gothic': ['"Franklin Gothic"', '"Arial Bold"'],
      //   'Garamond': ['Garamond', 'Baskerville', '"Baskerville Old Face"', '"Hoefler Text"', '"Times New Roman"', 'serif'],
      //   'Georgia': ['Georgia', 'Times', '"Times New Roman"', 'serif'],
      //   'Gill Sans': ['"Gill Sans"', '"Gill Sans MT"', 'Calibri', 'sans-serif'],
      //   'GoudyOld Style': ['"Goudy Old Style"', 'Garamond', '"Big Caslon"', '"Times New Roman"', 'serif'],
      //   'Helvetica Neue': ['"Helvetica Neue"', 'Helvetica', 'Arial', 'sans-serif'],
      //   'Impact': ['Impact', 'Charcoal', '"Helvetica Inserat"', '"Bitstream Vera Sans Bold"', '"Arial Black"', 'sans-serif'],
      //   'Lucida Bright': ['"Lucida Bright"', 'Georgia', 'serif'],
      //   'Lucida Handwriting': ['"Lucida Handwriting"', 'cursive'],
      //   'Lucida Sans': ['"Lucida Sans"', 'Helvetica', 'Arial', 'sans-serif'],
      //   'MS Sans Serif': ['"MS Sans Serif"', 'sans-serif'],
      //   'Optima': ['Optima', 'Segoe', '"Segoe UI"', 'Candara', 'Calibri', 'Arial', 'sans-serif'],
      //   'Palatino': ['Palatino', '"Palatino Linotype"', '"Palatino LT STD"', '"Book Antiqua"', 'Georgia', 'serif'],
      //   'Perpetua': ['Perpetua', 'Baskerville', '"Big Caslon"', '"Palatino Linotype"', 'Palatino', 'serif'],
      //   'Rage': ['Rage', 'cursive'],
      //   'Rockwell': ['Rockwell', '"Courier Bold"', 'Courier', 'Georgia', 'Times', '"Times New Roman"', 'serif'],
      //   'Script MT': ['"Script MT"', 'cursive'],
      //   'Segoescript': ['"Segoe script"', 'cursive'],
      //   'Segoe UI': ['"Segoe UI"', 'Frutiger', '"Dejavu Sans"', '"Helvetica Neue"', 'Arial', 'sans-serif'],
      //   'Snell Roundhand': ['"Snell Roundhand"', 'cursive'],
      //   'Tahoma': ['Tahoma', 'Verdana', 'Segoe', 'sans-serif'],
      //   'Trebuchet MS': ['"Trebuchet MS"', '"Lucida Grande"', '"Lucida Sans Unicode"', '"Lucida Sans"', 'sans-serif'],
      //   'Verdana': ['Verdana', 'Geneva', 'sans-serif']
      // }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

