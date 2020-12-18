# Package


## Display a listing of packages.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/packages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/packages"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (500):

```json
{
    "message": "SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it.\r\n (SQL: select * from `sessions` where `id` = Wy1P2HK6ttHHtLyJ7X2Dovtr3yhLi1U2Q9TrW1Kg limit 1)",
    "exception": "Illuminate\\Database\\QueryException",
    "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php",
    "line": 671,
    "trace": [
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php",
            "line": 631,
            "function": "runQueryCallback",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php",
            "line": 339,
            "function": "run",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Query\\Builder.php",
            "line": 2302,
            "function": "select",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Query\\Builder.php",
            "line": 2290,
            "function": "runSelect",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Query\\Builder.php",
            "line": 2785,
            "function": "Illuminate\\Database\\Query\\{closure}",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Query\\Builder.php",
            "line": 2291,
            "function": "onceWithColumns",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Concerns\\BuildsQueries.php",
            "line": 147,
            "function": "get",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Query\\Builder.php",
            "line": 2265,
            "function": "first",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\DatabaseSessionHandler.php",
            "line": 91,
            "function": "find",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Store.php",
            "line": 97,
            "function": "read",
            "class": "Illuminate\\Session\\DatabaseSessionHandler",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Store.php",
            "line": 87,
            "function": "readFromHandler",
            "class": "Illuminate\\Session\\Store",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Store.php",
            "line": 71,
            "function": "loadSession",
            "class": "Illuminate\\Session\\Store",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Middleware\\StartSession.php",
            "line": 147,
            "function": "start",
            "class": "Illuminate\\Session\\Store",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php",
            "line": 263,
            "function": "Illuminate\\Session\\Middleware\\{closure}",
            "class": "Illuminate\\Session\\Middleware\\StartSession",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Middleware\\StartSession.php",
            "line": 148,
            "function": "tap"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Middleware\\StartSession.php",
            "line": 116,
            "function": "startSession",
            "class": "Illuminate\\Session\\Middleware\\StartSession",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Middleware\\StartSession.php",
            "line": 63,
            "function": "handleStatefulRequest",
            "class": "Illuminate\\Session\\Middleware\\StartSession",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Session\\Middleware\\StartSession",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse.php",
            "line": 37,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Cookie\\Middleware\\EncryptCookies.php",
            "line": 67,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\EncryptCookies",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 693,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 668,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 634,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 623,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 166,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 128,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php",
            "line": 87,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\fideloper\\proxy\\src\\TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 141,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 110,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php",
            "line": 324,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php",
            "line": 305,
            "function": "callLaravelOrLumenRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php",
            "line": 76,
            "function": "makeApiCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php",
            "line": 51,
            "function": "makeResponseCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php",
            "line": 41,
            "function": "makeResponseCallIfEnabledAndNoSuccessResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Generator.php",
            "line": 236,
            "function": "__invoke",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Generator.php",
            "line": 172,
            "function": "iterateThroughStrategies",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Generator.php",
            "line": 127,
            "function": "fetchResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Commands\\GenerateDocumentation.php",
            "line": 119,
            "function": "processRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\knuckleswtf\\scribe\\src\\Commands\\GenerateDocumentation.php",
            "line": 73,
            "function": "processRoutes",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php",
            "line": 37,
            "function": "call_user_func_array"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php",
            "line": 40,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php",
            "line": 95,
            "function": "unwrapIfClosure",
            "class": "Illuminate\\Container\\Util",
            "type": "::"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php",
            "line": 39,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php",
            "line": 596,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php",
            "line": 136,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\symfony\\console\\Command\\Command.php",
            "line": 255,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php",
            "line": 121,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\symfony\\console\\Application.php",
            "line": 971,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\symfony\\console\\Application.php",
            "line": 290,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\symfony\\console\\Application.php",
            "line": 166,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php",
            "line": 93,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php",
            "line": 129,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "C:\\Users\\koude\\Eshop\\artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```
<div id="execution-results-GETorders--order--packages" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders--order--packages"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders--order--packages"></code></pre>
</div>
<div id="execution-error-GETorders--order--packages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders--order--packages"></code></pre>
</div>
<form id="form-GETorders--order--packages" data-method="GET" data-path="orders/{order}/packages" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders--order--packages', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders--order--packages" onclick="tryItOut('GETorders--order--packages');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders--order--packages" onclick="cancelTryOut('GETorders--order--packages');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders--order--packages" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders/{order}/packages</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="GETorders--order--packages" data-component="url" required  hidden>
<br>
order id</p>
</form>


## Store a newly created package in storage.


Geis - cod, b2c, routing_id, phone, driver_note, recipient_note, source, gar, package_order
| Postcz - source, cod, commercial, service, phone, package_order, weight
| Zásilkovna - cod, weight

> Example request:

```bash
curl -X POST \
    "http://localhost/orders/35022/packages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"cod":559005.285624,"b2c":6,"routing_id":13,"phone":"velit","driver_note":"corporis","recipient_note":"exercitationem","source":15,"gar":7,"package_order":16,"commercial":13,"service":"et","weight":3436.8154677}'

```

```javascript
const url = new URL(
    "http://localhost/orders/35022/packages"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "cod": 559005.285624,
    "b2c": 6,
    "routing_id": 13,
    "phone": "velit",
    "driver_note": "corporis",
    "recipient_note": "exercitationem",
    "source": 15,
    "gar": 7,
    "package_order": 16,
    "commercial": 13,
    "service": "et",
    "weight": 3436.8154677
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json
{
    "delivery_id": 8092812000,
    "package_id": 8092812000
}
```
<div id="execution-results-POSTorders--order--packages" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTorders--order--packages"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTorders--order--packages"></code></pre>
</div>
<div id="execution-error-POSTorders--order--packages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTorders--order--packages"></code></pre>
</div>
<form id="form-POSTorders--order--packages" data-method="POST" data-path="orders/{order}/packages" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTorders--order--packages', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTorders--order--packages" onclick="tryItOut('POSTorders--order--packages');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTorders--order--packages" onclick="cancelTryOut('POSTorders--order--packages');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTorders--order--packages" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>orders/{order}/packages</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="POSTorders--order--packages" data-component="url" required  hidden>
<br>
order id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>cod</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
<input type="number" name="cod" data-endpoint="POSTorders--order--packages" data-component="body" required  hidden>
<br>
Whether it has cash on delivery for the customer to pay.</p>
<p>
<b><code>b2c</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="b2c" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>routing_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="routing_id" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="phone" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>driver_note</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="driver_note" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>recipient_note</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="recipient_note" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>source</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="source" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>gar</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="gar" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>package_order</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="package_order" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>commercial</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="commercial" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>service</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="service" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>weight</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="weight" data-endpoint="POSTorders--order--packages" data-component="body"  hidden>
<br>
The weight of the package.</p>

</form>


## Update the specified package in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/35022/packages/quae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/packages/quae"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response => response.json());
```


<div id="execution-results-PUTorders--order--packages--package-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTorders--order--packages--package-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTorders--order--packages--package-"></code></pre>
</div>
<div id="execution-error-PUTorders--order--packages--package-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTorders--order--packages--package-"></code></pre>
</div>
<form id="form-PUTorders--order--packages--package-" data-method="PUT" data-path="orders/{order}/packages/{package}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTorders--order--packages--package-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTorders--order--packages--package-" onclick="tryItOut('PUTorders--order--packages--package-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTorders--order--packages--package-" onclick="cancelTryOut('PUTorders--order--packages--package-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTorders--order--packages--package-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>orders/{order}/packages/{package}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>orders/{order}/packages/{package}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="PUTorders--order--packages--package-" data-component="url" required  hidden>
<br>
order id</p>
<p>
<b><code>package</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="package" data-endpoint="PUTorders--order--packages--package-" data-component="url" required  hidden>
<br>
</p>
</form>


## Remove the specified package from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/orders/qui/packages/aspernatur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/qui/packages/aspernatur"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response => response.json());
```


<div id="execution-results-DELETEorders--order--packages--package-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEorders--order--packages--package-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEorders--order--packages--package-"></code></pre>
</div>
<div id="execution-error-DELETEorders--order--packages--package-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEorders--order--packages--package-"></code></pre>
</div>
<form id="form-DELETEorders--order--packages--package-" data-method="DELETE" data-path="orders/{order}/packages/{package}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEorders--order--packages--package-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEorders--order--packages--package-" onclick="tryItOut('DELETEorders--order--packages--package-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEorders--order--packages--package-" onclick="cancelTryOut('DELETEorders--order--packages--package-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEorders--order--packages--package-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>orders/{order}/packages/{package}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="DELETEorders--order--packages--package-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>package</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="package" data-endpoint="DELETEorders--order--packages--package-" data-component="url" required  hidden>
<br>
</p>
</form>



