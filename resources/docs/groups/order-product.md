# Order_product


## Display a listing of all ordered products.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products"
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
"order_product_id:112,
"order_id":50,
"product_id":183,
"name":"Náhradní hřebeny SP-HC5000",
"model":"4008496717552",
"price":207.5000,
"total":207.5000,
"tax":21.0000,
"quantity":1,
"sort_order":0,
"is_transfer":0,
"is_action":0,
"purchase_price":131.8200,
"warranty":24,
"gift":0
]}
```
<div id="execution-results-GETorders--order--products" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders--order--products"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders--order--products"></code></pre>
</div>
<div id="execution-error-GETorders--order--products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders--order--products"></code></pre>
</div>
<form id="form-GETorders--order--products" data-method="GET" data-path="orders/{order}/products" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders--order--products', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders--order--products" onclick="tryItOut('GETorders--order--products');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders--order--products" onclick="cancelTryOut('GETorders--order--products');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders--order--products" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders/{order}/products</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="GETorders--order--products" data-component="url" required  hidden>
<br>
order id</p>
</form>


## Store a newly created ordered product in storage.




> Example request:

```bash
curl -X POST \
    "http://localhost/orders/35022/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"product_id":9,"quantity":20,"sort_order":6,"is_transfer":8,"is_action":12}'

```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 9,
    "quantity": 20,
    "sort_order": 6,
    "is_transfer": 8,
    "is_action": 12
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
    "order_product_id": 3332,
    "noTaxTotal": 100,
    "tax": 21,
    "total": 121
}
```
<div id="execution-results-POSTorders--order--products" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTorders--order--products"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTorders--order--products"></code></pre>
</div>
<div id="execution-error-POSTorders--order--products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTorders--order--products"></code></pre>
</div>
<form id="form-POSTorders--order--products" data-method="POST" data-path="orders/{order}/products" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTorders--order--products', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTorders--order--products" onclick="tryItOut('POSTorders--order--products');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTorders--order--products" onclick="cancelTryOut('POSTorders--order--products');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTorders--order--products" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>orders/{order}/products</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="POSTorders--order--products" data-component="url" required  hidden>
<br>
order id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>product_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="product_id" data-endpoint="POSTorders--order--products" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>quantity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="quantity" data-endpoint="POSTorders--order--products" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>sort_order</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="sort_order" data-endpoint="POSTorders--order--products" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>is_transfer</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="is_transfer" data-endpoint="POSTorders--order--products" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>is_action</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="is_action" data-endpoint="POSTorders--order--products" data-component="body"  hidden>
<br>
</p>

</form>


## Display the specified ordered product.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/products/itaque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products/itaque"
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
"order_product_id:112,
"order_id":50,
"product_id":183,
"name":"Náhradní hřebeny SP-HC5000",
"model":"4008496717552",
"price":207.5000,
"total":207.5000,
"tax":21.0000,
"quantity":1,
"sort_order":0,
"is_transfer":0,
"is_action":0,
"purchase_price":131.8200,
"warranty":24,
"gift":0
}
```
<div id="execution-results-GETorders--order--products--product-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders--order--products--product-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders--order--products--product-"></code></pre>
</div>
<div id="execution-error-GETorders--order--products--product-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders--order--products--product-"></code></pre>
</div>
<form id="form-GETorders--order--products--product-" data-method="GET" data-path="orders/{order}/products/{product}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders--order--products--product-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders--order--products--product-" onclick="tryItOut('GETorders--order--products--product-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders--order--products--product-" onclick="cancelTryOut('GETorders--order--products--product-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders--order--products--product-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders/{order}/products/{product}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="GETorders--order--products--product-" data-component="url" required  hidden>
<br>
order id</p>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="GETorders--order--products--product-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>order_product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order_product" data-endpoint="GETorders--order--products--product-" data-component="url" required  hidden>
<br>
order product id</p>
</form>


## Update the specified ordered product in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/35022/products/2400" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"quantity":5,"sort_order":1,"is_action":1}'

```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products/2400"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "quantity": 5,
    "sort_order": 1,
    "is_action": 1
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
    "quantity": true,
    "noTaxTotal": 100,
    "tax": 21,
    "total": 121
}
```
> Example response (200):

```json
{
    "quantity": false
}
```
<div id="execution-results-PUTorders--order--products--product-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTorders--order--products--product-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTorders--order--products--product-"></code></pre>
</div>
<div id="execution-error-PUTorders--order--products--product-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTorders--order--products--product-"></code></pre>
</div>
<form id="form-PUTorders--order--products--product-" data-method="PUT" data-path="orders/{order}/products/{product}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTorders--order--products--product-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTorders--order--products--product-" onclick="tryItOut('PUTorders--order--products--product-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTorders--order--products--product-" onclick="cancelTryOut('PUTorders--order--products--product-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTorders--order--products--product-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>orders/{order}/products/{product}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>orders/{order}/products/{product}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="PUTorders--order--products--product-" data-component="url" required  hidden>
<br>
order id</p>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="PUTorders--order--products--product-" data-component="url" required  hidden>
<br>
product id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>quantity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="quantity" data-endpoint="PUTorders--order--products--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>sort_order</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="sort_order" data-endpoint="PUTorders--order--products--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>is_action</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="is_action" data-endpoint="PUTorders--order--products--product-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified ordered product from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/orders/35022/products/2400" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products/2400"
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
> Example response (200):

```json
{
    "noTaxTotal": 100,
    "tax": 21,
    "total": 121
}
```
<div id="execution-results-DELETEorders--order--products--product-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEorders--order--products--product-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEorders--order--products--product-"></code></pre>
</div>
<div id="execution-error-DELETEorders--order--products--product-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEorders--order--products--product-"></code></pre>
</div>
<form id="form-DELETEorders--order--products--product-" data-method="DELETE" data-path="orders/{order}/products/{product}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEorders--order--products--product-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEorders--order--products--product-" onclick="tryItOut('DELETEorders--order--products--product-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEorders--order--products--product-" onclick="cancelTryOut('DELETEorders--order--products--product-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEorders--order--products--product-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>orders/{order}/products/{product}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="DELETEorders--order--products--product-" data-component="url" required  hidden>
<br>
order id</p>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="DELETEorders--order--products--product-" data-component="url" required  hidden>
<br>
product id</p>
</form>



