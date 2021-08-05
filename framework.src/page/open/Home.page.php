<?php

/*
PAGEINFO
Title: false;
Master: null;
*/
?>

<img src="/content/img/fav.png" alt="Logo" class="logo-main", id="logo-main"/>

<h2>Welcome to the Corsify Proxy</h2>
<p>This page will give you a ruff description, how to use the proxy API</p>
<br />
<p>
     First of all, this proxy is intended to be used only with endpoints that have permission from the owner. We are not responsible for actions against this premise.
     Further details can be found in our <a href="/termsofuse">terms of use</a>!
</p>
<br />
<hr>
<p>Here we have an basic example of how we talk to the API</p>
<p><code>https://domain/API.php?apiMode=feed&feedMode=rss&dataUrl=https://josunlp.de/feed</code></p>
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