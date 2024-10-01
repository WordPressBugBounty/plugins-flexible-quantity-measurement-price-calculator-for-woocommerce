const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
	entry: {
		admin: "./assets-src/js/admin/admin.js",
		front: "./assets-src/js/front/front.js",
	},
	output: {
		path: path.resolve(__dirname, "assets/js"),
		filename: "[name].js",
	},
	externals: {
		jquery: "jQuery",
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "../../assets/css/[name].css",
		}),
	],
	mode: "production",
};
