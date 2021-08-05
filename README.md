<img src="https://raw.githubusercontent.com/JosunLP/Corsify-proxy/main/framework.src/content/img/fav.png" width="400px" />

# Corsify Proxy Server

### A simple Proxy API that adds CORS Headers to Atom and RSS Feeds

This page will give you a ruff description, how to use the proxy API

First of all, this proxy is intended to be used only with endpoints that have permission from the owner. We are not responsible for actions against this premise. Further details can be found in our terms of use!

Here we have an basic example of how we talk to the API

``` https://domain/API.php?apiMode=feed&feedMode=rss&dataUrl=https://josunlp.de/feed ```

To talk with the proxy API we select the apiMode feed.
Then we set our feedMode to eather rss or atom depending on the feed you want to use.
Then, finally, you choose the feed you want to send through the proxy via the dataUrl propperty.
