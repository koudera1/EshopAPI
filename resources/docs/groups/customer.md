# Customer


## Display a listing of all customers.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/customers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/customers"
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
"firstname":"Pavel",
"lastname":"Modrý",
"email":"jan.modry@seznam.cz",
"telephone":"774215321",
"company":"Hyundai",
"address_1":"Zámecká 702"",
"address_2":"",
"postcode":"75501",
"city":"Olomouc"
]}
```
<div id="execution-results-GETcustomers" hidden>
    <blockquote>Received response<span id="execution-response-status-GETcustomers"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomers"></code></pre>
</div>
<div id="execution-error-GETcustomers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomers"></code></pre>
</div>
<form id="form-GETcustomers" data-method="GET" data-path="customers" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETcustomers', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETcustomers" onclick="tryItOut('GETcustomers');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETcustomers" onclick="cancelTryOut('GETcustomers');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETcustomers" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>customers</code></b>
</p>
</form>


## Display the specified customer.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/customers/ab" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/customers/ab"
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
"firstname":"Pavel",
"lastname":"Modrý",
"email":"jan.modry@seznam.cz",
"telephone":"774215321",
"company":"Hyundai",
"address_1":"Zámecká 702"",
"address_2":"",
"postcode":"75501",
"city":"Olomouc"
}
```
<div id="execution-results-GETcustomers--customer-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETcustomers--customer-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomers--customer-"></code></pre>
</div>
<div id="execution-error-GETcustomers--customer-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomers--customer-"></code></pre>
</div>
<form id="form-GETcustomers--customer-" data-method="GET" data-path="customers/{customer}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETcustomers--customer-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETcustomers--customer-" onclick="tryItOut('GETcustomers--customer-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETcustomers--customer-" onclick="cancelTryOut('GETcustomers--customer-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETcustomers--customer-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>customers/{customer}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>customer</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="customer" data-endpoint="GETcustomers--customer-" data-component="url" required  hidden>
<br>
customer id</p>
</form>


## Update the specified customer in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/customers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"firstname":"delectus","lastname":"provident","email":"omnis","telephone":"ut","shipping_firstname":{},"shipping_lastname":{},"shipping_address_1":{},"shipping_address_2":{},"shipping_city":{},"shipping_postcode":{},"shipping_country":{},"payment_firstname":{},"payment_lastname":{},"payment_address_1":{},"payment_address_2":{},"payment_city":{},"payment_postcode":{},"payment_country":{},"company":"distinctio","address_1":"voluptas","address_2":"et","city":"corporis","postcode":"quibusdam","zone":"quas","country":"eaque","fax":"quae","ip":"sequi","newsletter":14,"status":9,"customer_group_id":12,"periodSaleTotal":462086.33459,"allow_discount":14}'

```

```javascript
const url = new URL(
    "http://localhost/customers/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "firstname": "delectus",
    "lastname": "provident",
    "email": "omnis",
    "telephone": "ut",
    "shipping_firstname": {},
    "shipping_lastname": {},
    "shipping_address_1": {},
    "shipping_address_2": {},
    "shipping_city": {},
    "shipping_postcode": {},
    "shipping_country": {},
    "payment_firstname": {},
    "payment_lastname": {},
    "payment_address_1": {},
    "payment_address_2": {},
    "payment_city": {},
    "payment_postcode": {},
    "payment_country": {},
    "company": "distinctio",
    "address_1": "voluptas",
    "address_2": "et",
    "city": "corporis",
    "postcode": "quibusdam",
    "zone": "quas",
    "country": "eaque",
    "fax": "quae",
    "ip": "sequi",
    "newsletter": 14,
    "status": 9,
    "customer_group_id": 12,
    "periodSaleTotal": 462086.33459,
    "allow_discount": 14
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
    "firstname": true,
    "lastname": true
}
```
<div id="execution-results-PUTcustomers--customer-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTcustomers--customer-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTcustomers--customer-"></code></pre>
</div>
<div id="execution-error-PUTcustomers--customer-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTcustomers--customer-"></code></pre>
</div>
<form id="form-PUTcustomers--customer-" data-method="PUT" data-path="customers/{customer}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTcustomers--customer-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTcustomers--customer-" onclick="tryItOut('PUTcustomers--customer-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTcustomers--customer-" onclick="cancelTryOut('PUTcustomers--customer-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTcustomers--customer-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>customers/{customer}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>customers/{customer}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>customer</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="customer" data-endpoint="PUTcustomers--customer-" data-component="url" required  hidden>
<br>
customer id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>firstname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="firstname" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>lastname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="lastname" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="email" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>telephone</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="telephone" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_firstname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_firstname" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_lastname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_lastname" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_address_1</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_address_1" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_address_2</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_address_2" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_city</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_city" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_postcode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_postcode" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping_country</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="shipping_country" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_firstname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_firstname" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_lastname</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_lastname" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_address_1</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_address_1" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_address_2</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_address_2" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_city</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_city" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_postcode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_postcode" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>payment_country</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="payment_country" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>company</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="company" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>address_1</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="address_1" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>address_2</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="address_2" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>city</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="city" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>postcode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="postcode" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>zone</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="zone" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>country</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="country" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>fax</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="fax" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>ip</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="ip" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>newsletter</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="newsletter" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>customer_group_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="customer_group_id" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>periodSaleTotal</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="periodSaleTotal" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>allow_discount</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="allow_discount" data-endpoint="PUTcustomers--customer-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified customer from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/customers/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/customers/et"
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


<div id="execution-results-DELETEcustomers--customer-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEcustomers--customer-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEcustomers--customer-"></code></pre>
</div>
<div id="execution-error-DELETEcustomers--customer-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEcustomers--customer-"></code></pre>
</div>
<form id="form-DELETEcustomers--customer-" data-method="DELETE" data-path="customers/{customer}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEcustomers--customer-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEcustomers--customer-" onclick="tryItOut('DELETEcustomers--customer-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEcustomers--customer-" onclick="cancelTryOut('DELETEcustomers--customer-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEcustomers--customer-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>customers/{customer}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>customer</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="customer" data-endpoint="DELETEcustomers--customer-" data-component="url" required  hidden>
<br>
</p>
</form>



