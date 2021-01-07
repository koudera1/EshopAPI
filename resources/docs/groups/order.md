# Order


## Display addresses of the order.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/addresses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/addresses"
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
    "shipping_firstname": "Jindrich",
    "shipping_lastname": "Dvorak",
    "shipping_company": "Tisk Liška",
    "shipping_address_1": "Dlouhá 32",
    "shipping_address_2": "",
    "shipping_city": "Litoměřice",
    "shipping_postcode": "412 01",
    "shipping_zone": "",
    "shipping_zone_id": 899,
    "shipping_country": "Česká republika",
    "shipping_country_id": 56,
    "shipping_address_format": "",
    "payment_firstname": "Jindrich",
    "payment_lastname": "Dvorak",
    "payment_company": "",
    "payment_address_1": "Dlouhá 32",
    "payment_address_2": "",
    "payment_city": "Litoměřice",
    "payment_postcode": "412 01",
    "payment_zone": "",
    "payment_zone_id": 899,
    "payment_country": "Česká republika",
    "payment_country_id": 56,
    "payment_address_format": ""
}
```
<div id="execution-results-GETorders--order--addresses" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders--order--addresses"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders--order--addresses"></code></pre>
</div>
<div id="execution-error-GETorders--order--addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders--order--addresses"></code></pre>
</div>
<form id="form-GETorders--order--addresses" data-method="GET" data-path="orders/{order}/addresses" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders--order--addresses', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders--order--addresses" onclick="tryItOut('GETorders--order--addresses');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders--order--addresses" onclick="cancelTryOut('GETorders--order--addresses');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders--order--addresses" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders/{order}/addresses</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="GETorders--order--addresses" data-component="url" required  hidden>
<br>
order id</p>
</form>


## Display all payment methods with corresponding prices.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/payment_methods" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/payment_methods"
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
    "Na dobírku": "40",
    "Platba kartou": 0,
    "Bankovní převod": 0,
    "Osobní odběr": 0
}
```
<div id="execution-results-GETorders--order--payment_methods" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders--order--payment_methods"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders--order--payment_methods"></code></pre>
</div>
<div id="execution-error-GETorders--order--payment_methods" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders--order--payment_methods"></code></pre>
</div>
<form id="form-GETorders--order--payment_methods" data-method="GET" data-path="orders/{order}/payment_methods" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders--order--payment_methods', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders--order--payment_methods" onclick="tryItOut('GETorders--order--payment_methods');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders--order--payment_methods" onclick="cancelTryOut('GETorders--order--payment_methods');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders--order--payment_methods" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders/{order}/payment_methods</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="GETorders--order--payment_methods" data-component="url" required  hidden>
<br>
order id</p>
</form>


## Display all shipping methods with corresponding prices.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/shipping_methods" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/shipping_methods"
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
    "Česká pošta (Balík Do balíkovny)": "0",
    "Česká pošta (Balík Do ruky)": "89",
    "Česká pošta (Balík Na poštu)": "79",
    "Geis": "69",
    "Zásilkovna": "0",
    "DPD": "99"
}
```
<div id="execution-results-GETorders--order--shipping_methods" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders--order--shipping_methods"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders--order--shipping_methods"></code></pre>
</div>
<div id="execution-error-GETorders--order--shipping_methods" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders--order--shipping_methods"></code></pre>
</div>
<form id="form-GETorders--order--shipping_methods" data-method="GET" data-path="orders/{order}/shipping_methods" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders--order--shipping_methods', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders--order--shipping_methods" onclick="tryItOut('GETorders--order--shipping_methods');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders--order--shipping_methods" onclick="cancelTryOut('GETorders--order--shipping_methods');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders--order--shipping_methods" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders/{order}/shipping_methods</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="GETorders--order--shipping_methods" data-component="url" required  hidden>
<br>
order id</p>
</form>


## Display all order statuses.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/order_statuses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/order_statuses"
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
    "Nevyřízeno",
    "Ve zpracování",
    "Odesláno dopravcem",
    "Zákazník převzal zboží",
    "Zrušeno obchodem",
    "Nepřevzal zásilku",
    "Dobropisováno",
    "Připraveno k osobnímu odběru",
    "Čeká na uhrazení",
    "Uhrazeno - k expedici",
    "K expedici",
    "Vráceno ve 14ti dnech",
    "Zrušeno zákazníkem",
    "Zrušeno pro nezaplacení",
    "Dobropis",
    "Pouze zásilka"
]
```
<div id="execution-results-GETorder_statuses" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorder_statuses"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorder_statuses"></code></pre>
</div>
<div id="execution-error-GETorder_statuses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorder_statuses"></code></pre>
</div>
<form id="form-GETorder_statuses" data-method="GET" data-path="order_statuses" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorder_statuses', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorder_statuses" onclick="tryItOut('GETorder_statuses');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorder_statuses" onclick="cancelTryOut('GETorder_statuses');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorder_statuses" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>order_statuses</code></b>
</p>
</form>


## Make a new invoice.




> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/35202/invoice" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35202/invoice"
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


<div id="execution-results-PUTorders--order--invoice" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTorders--order--invoice"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTorders--order--invoice"></code></pre>
</div>
<div id="execution-error-PUTorders--order--invoice" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTorders--order--invoice"></code></pre>
</div>
<form id="form-PUTorders--order--invoice" data-method="PUT" data-path="orders/{order}/invoice" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTorders--order--invoice', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTorders--order--invoice" onclick="tryItOut('PUTorders--order--invoice');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTorders--order--invoice" onclick="cancelTryOut('PUTorders--order--invoice');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTorders--order--invoice" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>orders/{order}/invoice</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="PUTorders--order--invoice" data-component="url" required  hidden>
<br>
order id</p>
</form>


## Display a listing of orders.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders"
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
"order_id":35000,
"invoice_id":2018023,
"domain":'www.stylka.cz',
"firstname":'Jan',
"lastname":'Zelený',
"comment":'Objednávka zaplacena.',
"order_status":'Odesláno dopravcem'
"shipping_method":'Zásilkovna',
"label":1,
"date_added":"2018-07-13",
"total":453,
"payment_status":1,
"payment_status" => 1,
"profit" => 420,
"slovakia" => 0,
"instock" => 0,
"referrer" => 'Google',
"agree_gdpr" => 1,
"payment_method" => 'Platba kartou',
"email" => 'o@gmail.com',
"telephone" => '+420555111444',
]}
```
<div id="execution-results-GETorders" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders"></code></pre>
</div>
<div id="execution-error-GETorders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders"></code></pre>
</div>
<form id="form-GETorders" data-method="GET" data-path="orders" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders" onclick="tryItOut('GETorders');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders" onclick="cancelTryOut('GETorders');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders</code></b>
</p>
</form>


## Create a new order when a customer adds sth to his cart.




> Example request:

```bash
curl -X POST \
    "http://localhost/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"domain":"\"www.moje_medisana.cz\"","customer_id":"0","language":"\"\u010ce\u0161tina\"","ip":"\"165.154.213.546\"","referrer":"\"Google\"","product_id":"2400","quantity":"2"}'

```

```javascript
const url = new URL(
    "http://localhost/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "domain": "\"www.moje_medisana.cz\"",
    "customer_id": "0",
    "language": "\"\u010ce\u0161tina\"",
    "ip": "\"165.154.213.546\"",
    "referrer": "\"Google\"",
    "product_id": "2400",
    "quantity": "2"
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
    "order_id": 35022,
    "order_product_id": 3332
}
```
<div id="execution-results-POSTorders" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTorders"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTorders"></code></pre>
</div>
<div id="execution-error-POSTorders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTorders"></code></pre>
</div>
<form id="form-POSTorders" data-method="POST" data-path="orders" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTorders', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTorders" onclick="tryItOut('POSTorders');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTorders" onclick="cancelTryOut('POSTorders');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTorders" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>orders</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>domain</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="domain" data-endpoint="POSTorders" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>customer_id</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="customer_id" data-endpoint="POSTorders" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>language</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="language" data-endpoint="POSTorders" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>ip</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="ip" data-endpoint="POSTorders" data-component="body"  hidden>
<br>
ip address</p>
<p>
<b><code>referrer</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="referrer" data-endpoint="POSTorders" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>product_id</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="product_id" data-endpoint="POSTorders" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>quantity</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="quantity" data-endpoint="POSTorders" data-component="body"  hidden>
<br>
The quantity of products.</p>

</form>


## Display the specified order.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022"
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
"order_id":35000,
"invoice_id":2018023,
"domain":'www.stylka.cz',
"firstname":'Jan',
"lastname":'Zelený',
"comment":'Objednávka zaplacena.',
"order_status":'Odesláno dopravcem'
"shipping_method":'Zásilkovna',
"label":1,
"date_added":2018-07-13,
"total":453,
"payment_status":1,
"payment_status" => 1,
"profit" => 420,
"slovakia" => 0,
"instock" => 0,
"referrer" => 'Google',
"agree_gdpr" => 1,
"payment_method" => 'Platba kartou',
"email" => 'o@gmail.com',
"telephone" => '+420555111444',
}
```
<div id="execution-results-GETorders--order-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETorders--order-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETorders--order-"></code></pre>
</div>
<div id="execution-error-GETorders--order-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorders--order-"></code></pre>
</div>
<form id="form-GETorders--order-" data-method="GET" data-path="orders/{order}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETorders--order-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETorders--order-" onclick="tryItOut('GETorders--order-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETorders--order-" onclick="cancelTryOut('GETorders--order-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETorders--order-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>orders/{order}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="GETorders--order-" data-component="url" required  hidden>
<br>
order id</p>
</form>


## Update the specified order in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/35022" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"firstname":"architecto","lastname":"et","email":"et","telephone":"et","shipping_firstname":"error","shipping_lastname":"omnis","shipping_address_1":"illum","shipping_address_2":"dicta","shipping_city":"eos","shipping_postcode":"eos","shipping_country":"velit","payment_firstname":"quam","payment_lastname":"aperiam","payment_address_1":"eveniet","payment_address_2":"aperiam","payment_city":"error","payment_postcode":"vel","payment_country":"rem","domain":"\"www.stylka.cz\"","currency":"ratione","customer_id":15,"language":"quibusdam","company":"sunt","comment_c":"aut","comment_e":"minus","notify":"nisi","order_status":"\"Nevy\u0159\u00edzeno.\"","shipping_method":"\"Z\u00e1silkovna\"","payment_status":1,"referrer":"officia","agree_gdpr":1,"payment_method":"provident","fax":"facere","regNum":"quia","taxRegNum":"facere","ip":"reprehenderit","reason":"\"Reklamace\"","wrong_order_id":6,"competition":7,"euVAT":14,"viewed":0,"shipping_company":"itaque","shipping_zone":"possimus","shipping_address_format":"harum","payment_company":"nulla","payment_zone":"omnis","payment_address_format":"sit"}'

```

```javascript
const url = new URL(
    "http://localhost/orders/35022"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "firstname": "architecto",
    "lastname": "et",
    "email": "et",
    "telephone": "et",
    "shipping_firstname": "error",
    "shipping_lastname": "omnis",
    "shipping_address_1": "illum",
    "shipping_address_2": "dicta",
    "shipping_city": "eos",
    "shipping_postcode": "eos",
    "shipping_country": "velit",
    "payment_firstname": "quam",
    "payment_lastname": "aperiam",
    "payment_address_1": "eveniet",
    "payment_address_2": "aperiam",
    "payment_city": "error",
    "payment_postcode": "vel",
    "payment_country": "rem",
    "domain": "\"www.stylka.cz\"",
    "currency": "ratione",
    "customer_id": 15,
    "language": "quibusdam",
    "company": "sunt",
    "comment_c": "aut",
    "comment_e": "minus",
    "notify": "nisi",
    "order_status": "\"Nevy\u0159\u00edzeno.\"",
    "shipping_method": "\"Z\u00e1silkovna\"",
    "payment_status": 1,
    "referrer": "officia",
    "agree_gdpr": 1,
    "payment_method": "provident",
    "fax": "facere",
    "regNum": "quia",
    "taxRegNum": "facere",
    "ip": "reprehenderit",
    "reason": "\"Reklamace\"",
    "wrong_order_id": 6,
    "competition": 7,
    "euVAT": 14,
    "viewed": 0,
    "shipping_company": "itaque",
    "shipping_zone": "possimus",
    "shipping_address_format": "harum",
    "payment_company": "nulla",
    "payment_zone": "omnis",
    "payment_address_format": "sit"
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
    "domain": true,
    "currency": true,
    "noTaxTotal": 100,
    "tax": 21,
    "total": 121
}
```
<div id="execution-results-PUTorders--order-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTorders--order-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTorders--order-"></code></pre>
</div>
<div id="execution-error-PUTorders--order-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTorders--order-"></code></pre>
</div>
<form id="form-PUTorders--order-" data-method="PUT" data-path="orders/{order}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTorders--order-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTorders--order-" onclick="tryItOut('PUTorders--order-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTorders--order-" onclick="cancelTryOut('PUTorders--order-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTorders--order-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>orders/{order}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>orders/{order}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="PUTorders--order-" data-component="url" required  hidden>
<br>
order id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>firstname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="firstname" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>lastname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="lastname" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="email" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>telephone</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="telephone" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_firstname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_firstname" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_lastname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_lastname" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_address_1</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_address_1" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_address_2</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_address_2" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_city</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_city" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_postcode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_postcode" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_country</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_country" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_firstname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_firstname" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_lastname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_lastname" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_address_1</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_address_1" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_address_2</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_address_2" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_city</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_city" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_postcode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_postcode" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_country</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_country" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>domain</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="domain" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>currency</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="currency" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>customer_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="customer_id" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>language</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="language" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>company</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="company" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>comment_c</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="comment_c" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
The comment written by the customer.</p>
<p>
<b><code>comment_e</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="comment_e" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
The comment written by somebody else than customer.</p>
<p>
<b><code>notify</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="notify" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>order_status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="order_status" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_method</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_method" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="payment_status" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
Whether the order was paid.</p>
<p>
<b><code>referrer</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="referrer" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
The source website where the customer has come from.</p>
<p>
<b><code>agree_gdpr</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="agree_gdpr" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
Whether the customer agrees with gdpr policy.</p>
<p>
<b><code>payment_method</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_method" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>fax</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="fax" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>regNum</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="regNum" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
In Czech language IČO.</p>
<p>
<b><code>taxRegNum</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="taxRegNum" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
In Czech language DIČO.</p>
<p>
<b><code>ip</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="ip" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>reason</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="reason" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>wrong_order_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="wrong_order_id" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>competition</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="competition" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>euVAT</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="euVAT" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
Whether the order has been viewed.</p>
<p>
<b><code>shipping_company</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_company" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_zone</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_zone" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_address_format</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_address_format" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_company</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_company" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_zone</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_zone" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_address_format</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_address_format" data-endpoint="PUTorders--order-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified order from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/orders/35022" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022"
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
<div id="execution-results-DELETEorders--order-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEorders--order-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEorders--order-"></code></pre>
</div>
<div id="execution-error-DELETEorders--order-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEorders--order-"></code></pre>
</div>
<form id="form-DELETEorders--order-" data-method="DELETE" data-path="orders/{order}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEorders--order-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEorders--order-" onclick="tryItOut('DELETEorders--order-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEorders--order-" onclick="cancelTryOut('DELETEorders--order-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEorders--order-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>orders/{order}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>order</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order" data-endpoint="DELETEorders--order-" data-component="url" required  hidden>
<br>
order id</p>
</form>



