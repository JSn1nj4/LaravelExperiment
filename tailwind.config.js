/*

Tailwind - The Utility-First CSS Framework

A project by Adam Wathan (@adamwathan), Jonathan Reinink (@reinink),
David Hemphill (@davidhemphill) and Steve Schoger (@steveschoger).

Welcome to the Tailwind config file. This is where you can customize
Tailwind specifically for your project. Don't be intimidated by the
length of this file. It's really just a big JavaScript object and
we've done our very best to explain each section.

View the full documentation at https://tailwindcss.com.


|-------------------------------------------------------------------------------
| The default config
|-------------------------------------------------------------------------------
|
| This variable contains the default Tailwind config. You don't have
| to use it, but it can sometimes be helpful to have available. For
| example, you may choose to merge your custom configuration
| values with some of the Tailwind defaults.
|
*/

module.exports = {

  theme: {

    colors: {
      transparent: 'transparent',

      black: '#090909',
      'grey-darkest': '#151515',
      'grey-darker': '#606f7b',
      'grey-dark': '#8795a1',
      grey: '#b8c2cc',
      'grey-light': '#dae1e7',
      'grey-lighter': '#f1f5f8',
      'grey-lightest': '#f8fafc',
      white: "#ffffff",

      'red-darkest': '#3b0d0c',
      'red-darker': '#621b18',
      'red-dark': '#cc1f1a',
      red: '#e3342f',
      'red-light': '#ef5753',
      'red-lighter': '#f9acaa',
      'red-lightest': '#fcebea',

      'yellow-darkest': '#453411',
      'yellow-darker': '#684f1d',
      'yellow-dark': '#f2d024',
      'yellow': '#ffed4a',
      'yellow-light': '#fff382',
      'yellow-lighter': '#fff9c2',
      'yellow-lightest': '#fcfbeb',

      'green-darkest': '#0f2f21',
      'green-darker': '#1a4731',
      'green-dark': '#1f9d55',
      'green': '#38c172',
      'green-light': '#51d88a',
      'green-lighter': '#a2f5bf',
      'green-lightest': '#e3fcec',

      'sea-green-darkest': '#002C02',
      'sea-green-darker': '#00572D',
      'sea-green-dark': '#00A87E',
      'sea-green': '#00C49A',
      'sea-green-light': '#26EAC0',
      'sea-green-lighter': '#8BFFFF',
      'sea-green-lightest': '#CAFFFF',

      'teal-darkest': '#0d3331',
      'teal-darker': '#20504f',
      'teal-dark': '#38a89d',
      'teal': '#4dc0b5',
      'teal-light': '#64d5ca',
      'teal-lighter': '#a0f0ed',
      'teal-lightest': '#e8fffe',
    },

    spacing: {
      px: '1px',
      '0': '0',
      '1': '0.25rem',
      '2': '0.5rem',
      '3': '0.75rem',
      '4': '1rem',
      '5': '1.25rem',
      '6': '1.5rem',
      '8': '2rem',
      '10': '2.5rem',
      '12': '3rem',
      '16': '4rem',
      '20': '5rem',
      '24': '6rem',
      '32': '8rem',
      '40': '10rem',
      '48': '12rem',
      '56': '14rem',
      '64': '16rem',
    },

    screens: {
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
    },

    fontWeight: {
      thin: 200,
      normal: 400,
      bold: 700,
    },

    // TODO: come back later and update to match default config
    // Also replace classes in markup as necessary
    letterSpacing: {
      tight: '-0.05em',
      normal: '0',
      wide: '0.05em',
    },

    textColor: theme => theme('colors'),

    backgroundColor: theme => theme('colors'),

    borderColor: theme => ({
      default: theme('colors.grey-light'),
      ...theme('colors'),
    }),

    maxWidth: {
      xs: '20rem',
      sm: '30rem',
      md: '40rem',
      lg: '50rem',
      xl: '60rem',
      '2xl': '70rem',
      '3xl': '80rem',
      '4xl': '90rem',
      '5xl': '100rem',
      full: '100%',
    },

    padding: theme => ({
      'px2': '2px',
      ...theme('spacing')
    }),

  },

  variants: {
    alignContent: ['responsive'],
    alignItems: ['responsive'],
    alignSelf: ['responsive'],
    appearance: ['responsive'],
    backgroundAttachment: ['responsive'],
    backgroundColor: ['responsive', 'hover'],
    backgroundPosition: ['responsive'],
    backgroundRepeat: ['responsive'],
    backgroundSize: ['responsive'],
    borderColor: ['responsive', 'hover'],
    borderRadius: ['responsive'],
    borderStyle: ['responsive'],
    borderWidth: ['responsive'],
    boxShadow: ['responsive'],
    cursor: ['responsive'],
    display: ['responsive'],
    fill: [],
    flex: ['responsive'],
    flexDirection: ['responsive'],
    flexGrow: ['responsive'],
    flexShrink: ['responsive'],
    flexWrap: ['responsive'],
    float: ['responsive'],
    fontFamily: ['responsive'],
    fontSize: ['responsive'],
    fontSmoothing: ['responsive', 'hover'],
    fontStyle: ['responsive', 'hover'],
    fontWeight: ['responsive', 'hover'],
    height: ['responsive'],
    inset: ['responsive'],
    justifyContent: ['responsive'],
    letterSpacing: ['responsive'],
    lineHeight: ['responsive'],
    listStylePosition: ['responsive'],
    listStyleType: ['responsive'],
    margin: ['responsive'],
    maxHeight: ['responsive'],
    maxWidth: ['responsive'],
    minHeight: ['responsive'],
    minWidth: ['responsive'],
    negativeMargin: ['responsive'],
    opacity: ['responsive'],
    overflow: ['responsive'],
    padding: ['responsive'],
    pointerEvents: ['responsive'],
    position: ['responsive'],
    resize: ['responsive'],
    stroke: [],
    textAlign: ['responsive'],
    textColor: ['responsive', 'hover'],
    textDecoration: ['responsive', 'hover'],
    textTransform: ['responsive', 'hover'],
    userSelect: ['responsive'],
    verticalAlign: ['responsive'],
    visibility: ['responsive'],
    whitespace: ['responsive'],
    wordBreak: ['responsive'],
    width: ['responsive'],
    zIndex: ['responsive'],
  },

  corePlugins: {},

  plugins: [],

}
