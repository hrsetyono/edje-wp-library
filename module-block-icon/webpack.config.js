const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
var path = require('path');

const srcPath = './src';
const outputPath = 'dist';

const entryPoints = {
  'h-icon': srcPath + '/index.jsx',
};

module.exports = {
  entry: entryPoints,
  output: {
    path: path.resolve(__dirname, outputPath),
    filename: '[name].js',
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
    }),

    new DependencyExtractionWebpackPlugin( {
      injectPolyfill: true
    } ),
  ],
  module: {
    rules: [
      {
        test: /\.s?[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader',
        ]
      },
      {
        test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
        use: 'url-loader?limit=1024'
      },
      {
        test: /\.jsx$/i,
        use: [
					require.resolve( 'thread-loader' ),
					{
						loader: require.resolve( 'babel-loader' ),
						options: {
              cacheDirectory:	process.env.BABEL_CACHE_DIRECTORY || true,
              babelrc: false,
              configFile: false,
              presets: [
                require.resolve( '@wordpress/babel-preset-default' ),
              ],
						},
					},
				],
      }
    ]
  },
  
};