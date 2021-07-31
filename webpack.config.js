const path = require('path');

module.exports = {
    mode: "production", // "production" | "development" | "none"
    entry: "./framework.src/src/ts/index.ts", // string | object | array
    output: {
        path: path.resolve(__dirname, "./framework.src/content/js"), // string
        filename: "main.js", // string
    },
    devtool: "inline-source-map",
    module: {
        rules: [
            {
                test: /\.m?js$|\.tsx?$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env', '@babel/preset-typescript']
                    }
                }
            }
        ]
    },
    resolve: {
        extensions: ['.ts', '.js']
    }
};