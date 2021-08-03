<?php

/*
PAGEINFO
Title: false;
Master: null;
*/
?>

<h2>Welcome to the Corsify Proxy</h2>
<h4>This page will give you a ruff description, how to use the proxy API</h4>
<br />
<p>
     First of all, this proxy is intended to be used only with endpoints that have permission from the owner. We are not responsible for actions against this premise.
     Further details can be found in our <a href="/termsofuse">terms of use</a>!
</p>
<br />
<hr>
<h3>Here we have an basic example of how we talk to the API</h3>
<code>https://domain/API.php?apiMode=feed&feedMode=rss&dataUrl=https://josunlp.de/feed</code>
<br />
<div class="caption">
     <p>
          To talk with the proxy API we select the <b>apiMode</b> <code>feed</code>.
          <br />
          Then we set our <b>feedMode</b> to eather <code>rss</code> or <code>atom</code>
          depending on the feed you want to use.
          <br />
          Then, finally, you choose the feed you want to send through the proxy via the <b>dataUrl</b> propperty.
     </p>
</div>