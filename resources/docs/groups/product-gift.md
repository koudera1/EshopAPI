# Product_gift


## Display a listing of all product gifts.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/products/ut/gifts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/ut/gifts"
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

{[
"product_id":480,
"gift_id":376,
"quantity":1,
]}
```
<div id="execution-results-GETproducts--product--gifts" hidden>
    <blockquote>Received response<span id="execution-response-status-GETproducts--product--gifts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETproducts--product--gifts"></code></pre>
</div>
<div id="execution-error-GETproducts--product--gifts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETproducts--product--gifts"></code></pre>
</div>
<form id="form-GETproducts--product--gifts" data-method="GET" data-path="products/{product}/gifts" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETproducts--product--gifts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETproducts--product--gifts" onclick="tryItOut('GETproducts--product--gifts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETproducts--product--gifts" onclick="cancelTryOut('GETproducts--product--gifts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETproducts--product--gifts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>products/{product}/gifts</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="GETproducts--product--gifts" data-component="url" required  hidden>
<br>
product_id</p>
</form>


## Store a newly created product gift in storage.




> Example request:

```bash
curl -X POST \
    "http://localhost/products/dolores/gifts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"gift_id":9,"quantity":6}'

```

```javascript
const url = new URL(
    "http://localhost/products/dolores/gifts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "gift_id": 9,
    "quantity": 6
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json

{true}
```
<div id="execution-results-POSTproducts--product--gifts" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTproducts--product--gifts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTproducts--product--gifts"></code></pre>
</div>
<div id="execution-error-POSTproducts--product--gifts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTproducts--product--gifts"></code></pre>
</div>
<form id="form-POSTproducts--product--gifts" data-method="POST" data-path="products/{product}/gifts" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTproducts--product--gifts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTproducts--product--gifts" onclick="tryItOut('POSTproducts--product--gifts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTproducts--product--gifts" onclick="cancelTryOut('POSTproducts--product--gifts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTproducts--product--gifts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>products/{product}/gifts</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="POSTproducts--product--gifts" data-component="url" required  hidden>
<br>
product_id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>gift_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="gift_id" data-endpoint="POSTproducts--product--gifts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>quantity</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="quantity" data-endpoint="POSTproducts--product--gifts" data-component="body" required  hidden>
<br>
</p>

</form>


## Display the specified product gift.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/products/laudantium/gifts/tempore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/laudantium/gifts/tempore"
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

{
"product_id":480,
"gift_id":376,
"quantity":1,
}
```
<div id="execution-results-GETproducts--product--gifts--gift-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETproducts--product--gifts--gift-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETproducts--product--gifts--gift-"></code></pre>
</div>
<div id="execution-error-GETproducts--product--gifts--gift-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETproducts--product--gifts--gift-"></code></pre>
</div>
<form id="form-GETproducts--product--gifts--gift-" data-method="GET" data-path="products/{product}/gifts/{gift}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETproducts--product--gifts--gift-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETproducts--product--gifts--gift-" onclick="tryItOut('GETproducts--product--gifts--gift-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETproducts--product--gifts--gift-" onclick="cancelTryOut('GETproducts--product--gifts--gift-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETproducts--product--gifts--gift-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>products/{product}/gifts/{gift}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="GETproducts--product--gifts--gift-" data-component="url" required  hidden>
<br>
product_id</p>
<p>
<b><code>gift</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="gift" data-endpoint="GETproducts--product--gifts--gift-" data-component="url" required  hidden>
<br>
gift_id</p>
</form>


## Update the specified product gift in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/products/dolores/gifts/qui" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"product_id":2,"gift_id":1,"quantity":9}'

```

```javascript
const url = new URL(
    "http://localhost/products/dolores/gifts/qui"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 2,
    "gift_id": 1,
    "quantity": 9
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json
{
    "quantity": false
}
```
<div id="execution-results-PUTproducts--product--gifts--gift-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTproducts--product--gifts--gift-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTproducts--product--gifts--gift-"></code></pre>
</div>
<div id="execution-error-PUTproducts--product--gifts--gift-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTproducts--product--gifts--gift-"></code></pre>
</div>
<form id="form-PUTproducts--product--gifts--gift-" data-method="PUT" data-path="products/{product}/gifts/{gift}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTproducts--product--gifts--gift-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTproducts--product--gifts--gift-" onclick="tryItOut('PUTproducts--product--gifts--gift-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTproducts--product--gifts--gift-" onclick="cancelTryOut('PUTproducts--product--gifts--gift-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTproducts--product--gifts--gift-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>products/{product}/gifts/{gift}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>products/{product}/gifts/{gift}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="PUTproducts--product--gifts--gift-" data-component="url" required  hidden>
<br>
product_id</p>
<p>
<b><code>gift</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="gift" data-endpoint="PUTproducts--product--gifts--gift-" data-component="url" required  hidden>
<br>
gift_id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>product_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="product_id" data-endpoint="PUTproducts--product--gifts--gift-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>gift_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="gift_id" data-endpoint="PUTproducts--product--gifts--gift-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>quantity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="quantity" data-endpoint="PUTproducts--product--gifts--gift-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified product gift from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/products/nulla/gifts/doloremque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/nulla/gifts/doloremque"
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


> Example response (200):

```json
true
```
<div id="execution-results-DELETEproducts--product--gifts--gift-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEproducts--product--gifts--gift-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEproducts--product--gifts--gift-"></code></pre>
</div>
<div id="execution-error-DELETEproducts--product--gifts--gift-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEproducts--product--gifts--gift-"></code></pre>
</div>
<form id="form-DELETEproducts--product--gifts--gift-" data-method="DELETE" data-path="products/{product}/gifts/{gift}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEproducts--product--gifts--gift-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEproducts--product--gifts--gift-" onclick="tryItOut('DELETEproducts--product--gifts--gift-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEproducts--product--gifts--gift-" onclick="cancelTryOut('DELETEproducts--product--gifts--gift-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEproducts--product--gifts--gift-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>products/{product}/gifts/{gift}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="DELETEproducts--product--gifts--gift-" data-component="url" required  hidden>
<br>
product_id</p>
<p>
<b><code>gift</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="gift" data-endpoint="DELETEproducts--product--gifts--gift-" data-component="url" required  hidden>
<br>
gift_id</p>
</form>



