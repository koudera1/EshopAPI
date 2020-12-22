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


> Example response (200):

```json
[
    {
        "package_id": 3669041905,
        "order_id": 35022,
        "creation_time": "2019-11-15 10:59:45",
        "PacketAttributes": "{\"number\":\"35022\",\"name\":\"Jindrich\",\"surname\":\"Dvorak\",\"email\":\"Henrydvorak@centrum.cz\",\"phone\":\"+420737989254\",\"addressId\":\"3942\",\"currency\":\"CZK\",\"cod\":1370,\"value\":1370,\"weight\":\"3.932\",\"eshop\":\"stylka.cz\",\"street\":\"Dlouh\\u00e1 32\",\"houseNumber\":\"\",\"city\":\"Litom\\u011b\\u0159ice\",\"zip\":\"412 01\"}",
        "PacketIdDetail": "{\"id\":\"3669041905\",\"barcode\":\"Z3669041905\",\"barcodeText\":\"Z 366 9041 905\"}",
        "last_status": 5,
        "last_check": "2019-11-18 15:48:50",
        "protocol_id": 662,
        "active": 1
    }
]
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
    -d '{"cod":26425.2,"b2c":14,"routing_id":17,"phone":"esse","driver_note":"et","recipient_note":"et","source":5,"gar":18,"package_order":18,"commercial":15,"service":"eaque","weight":272638.74807218}'

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
    "cod": 26425.2,
    "b2c": 14,
    "routing_id": 17,
    "phone": "esse",
    "driver_note": "et",
    "recipient_note": "et",
    "source": 5,
    "gar": 18,
    "package_order": 18,
    "commercial": 15,
    "service": "eaque",
    "weight": 272638.74807218
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
    "http://localhost/orders/35022/packages/reiciendis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/packages/reiciendis"
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
    "http://localhost/orders/voluptas/packages/laudantium" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/voluptas/packages/laudantium"
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


