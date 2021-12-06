module.exports = {
	purge: [
		'./storage/framework/views/*.php',
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
	],
	darkMode: false, // or 'media' or 'class'
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/typography'),
		require('daisyui')
	],
	daisyui: {
		styled: true,
		themes: true,
		base: true,
		utils: true,
	}
}
