const path = require("path");
const Dotenv = require("dotenv-webpack");

module.exports = {
  entry: {
    video: "./assets/js/ajax/video.js",
    base: "./assets/js/ajax/base.js",
    client_video_search: "./assets/js/ajax/client_search_video.js",
    client_search_base: "./assets/js/ajax/client_search_base.js",
  },
  output: {
    path: path.resolve(__dirname, "assets", "js", "bundles"),
    filename: "[name].bundle.js",
    libraryTarget: "var",
    library: "func",
  },
  plugins: [new Dotenv()],
};
