<img src="https://raw.githubusercontent.com/JosunLP/Corsify-proxy/main/framework.src/content/img/fav.png" width="400px" />

# Corsify Proxy Server

[![GitHub issues](https://img.shields.io/github/issues/JosunLP/Corsify-proxy?style=for-the-badge)](https://github.com/JosunLP/Corsify-proxy/issues)
[![GitHub forks](https://img.shields.io/github/forks/JosunLP/Corsify-proxy?style=for-the-badge)](https://github.com/JosunLP/Corsify-proxy/network)
[![GitHub stars](https://img.shields.io/github/stars/JosunLP/Corsify-proxy?style=for-the-badge)](https://github.com/JosunLP/Corsify-proxy/stargazers)
[![GitHub license](https://img.shields.io/github/license/JosunLP/Corsify-proxy?style=for-the-badge)](https://github.com/JosunLP/Corsify-proxy/blob/main/LICENSE)
![CodeFactor Grade](https://img.shields.io/codefactor/grade/github/josunlp/corsify-proxy?style=for-the-badge)

### A simple Proxy API that adds CORS Headers to Atom and RSS Feeds

This page will give you a ruff description, how to use the proxy API

First of all, this proxy is intended to be used only with endpoints that have permission from the owner. We are not responsible for actions against this premise. Further details can be found in our terms of use!

Here we have an basic example of how we talk to the API

``` https://domain/API.php?apiMode=feed&feedMode=rss&dataUrl=https://josunlp.de/feed ```

To talk with the proxy API we select the apiMode feed.
Then we set our feedMode to eather rss or atom depending on the feed you want to use.
Then, finally, you choose the feed you want to send through the proxy via the dataUrl propperty.
