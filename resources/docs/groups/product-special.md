# Product_special


## Display a listing of all special product offers.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/products/illo/special" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/illo/special"
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
"product_special_id":470,
"product_id":236,
"customer_group_id":4,
"domain":"www.muj-russellhobbs.cz",
"priority":0,
"price":599,
"date_start":"",
"date_end":"2012-01-28 17:00:18",
"date_added":"2012-01-28 17:00:18"
]}
```
<div id="execution-results-GETproducts--product--special" hidden>
    <blockquote>Received response<span id="execution-response-status-GETproducts--product--special"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETproducts--product--special"></code></pre>
</div>
<div id="execution-error-GETproducts--product--special" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETproducts--product--special"></code></pre>
</div>
<form id="form-GETproducts--product--special" data-method="GET" data-path="products/{product}/special" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETproducts--product--special', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETproducts--product--special" onclick="tryItOut('GETproducts--product--special');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETproducts--product--special" onclick="cancelTryOut('GETproducts--product--special');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETproducts--product--special" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>products/{product}/special</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="GETproducts--product--special" data-component="url" required  hidden>
<br>
product_id</p>
</form>


## Store a newly created resource in storage.




> Example request:

```bash
curl -X POST \
    "http://localhost/products/et/special" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"product_id":16,"customer_group_id":19,"domain":"aut","priority":4,"price":20,"date_start":"commodi","date_end":"est"}'

```

```javascript
const url = new URL(
    "http://localhost/products/et/special"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 16,
    "customer_group_id": 19,
    "domain": "aut",
    "priority": 4,
    "price": 20,
    "date_start": "commodi",
    "date_end": "est"
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
    "product_special_id": 470
}
```
<div id="execution-results-POSTproducts--product--special" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTproducts--product--special"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTproducts--product--special"></code></pre>
</div>
<div id="execution-error-POSTproducts--product--special" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTproducts--product--special"></code></pre>
</div>
<form id="form-POSTproducts--product--special" data-method="POST" data-path="products/{product}/special" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTproducts--product--special', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTproducts--product--special" onclick="tryItOut('POSTproducts--product--special');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTproducts--product--special" onclick="cancelTryOut('POSTproducts--product--special');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTproducts--product--special" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>products/{product}/special</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="POSTproducts--product--special" data-component="url" required  hidden>
<br>
product_id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>product_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="product_id" data-endpoint="POSTproducts--product--special" data-component="body"  hidden>
<br>
required,</p>
<p>
<b><code>customer_group_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="customer_group_id" data-endpoint="POSTproducts--product--special" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>domain</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="domain" data-endpoint="POSTproducts--product--special" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>priority</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="priority" data-endpoint="POSTproducts--product--special" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>price</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="price" data-endpoint="POSTproducts--product--special" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>date_start</code></b>&nbsp;&nbsp;<small>date</small>     <i>optional</i> &nbsp;
<input type="text" name="date_start" data-endpoint="POSTproducts--product--special" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>date_end</code></b>&nbsp;&nbsp;<small>date</small>     <i>optional</i> &nbsp;
<input type="text" name="date_end" data-endpoint="POSTproducts--product--special" data-component="body"  hidden>
<br>
</p>

</form>


## Display the specified resource.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/products/totam/special/veniam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/totam/special/veniam"
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
    "product_special_id": 470,
    "product_id": 236,
    "customer_group_id": 4,
    "domain": "www.muj-russellhobbs.cz",
    "priority": 0,
    "price": 599,
    "date_start": "",
    "date_end": "2012-01-28 17:00:18",
    "date_added": "2012-01-28 17:00:18"
}
```
<div id="execution-results-GETproducts--product--special--special-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETproducts--product--special--special-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETproducts--product--special--special-"></code></pre>
</div>
<div id="execution-error-GETproducts--product--special--special-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETproducts--product--special--special-"></code></pre>
</div>
<form id="form-GETproducts--product--special--special-" data-method="GET" data-path="products/{product}/special/{special}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETproducts--product--special--special-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETproducts--product--special--special-" onclick="tryItOut('GETproducts--product--special--special-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETproducts--product--special--special-" onclick="cancelTryOut('GETproducts--product--special--special-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETproducts--product--special--special-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>products/{product}/special/{special}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="GETproducts--product--special--special-" data-component="url" required  hidden>
<br>
product_id</p>
<p>
<b><code>special</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="special" data-endpoint="GETproducts--product--special--special-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>product_special</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product_special" data-endpoint="GETproducts--product--special--special-" data-component="url" required  hidden>
<br>
product_special_id</p>
</form>


## Update the specified resource in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/products/aut/special/non" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"product_id":3,"customer_group_id":12,"domain":"accusamus","priority":12,"price":2,"date_start":"ipsum","date_end":"sit"}'

```

```javascript
const url = new URL(
    "http://localhost/products/aut/special/non"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 3,
    "customer_group_id": 12,
    "domain": "accusamus",
    "priority": 12,
    "price": 2,
    "date_start": "ipsum",
    "date_end": "sit"
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
    "price": true
}
```
<div id="execution-results-PUTproducts--product--special--special-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTproducts--product--special--special-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTproducts--product--special--special-"></code></pre>
</div>
<div id="execution-error-PUTproducts--product--special--special-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTproducts--product--special--special-"></code></pre>
</div>
<form id="form-PUTproducts--product--special--special-" data-method="PUT" data-path="products/{product}/special/{special}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTproducts--product--special--special-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTproducts--product--special--special-" onclick="tryItOut('PUTproducts--product--special--special-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTproducts--product--special--special-" onclick="cancelTryOut('PUTproducts--product--special--special-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTproducts--product--special--special-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>products/{product}/special/{special}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>products/{product}/special/{special}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="PUTproducts--product--special--special-" data-component="url" required  hidden>
<br>
product_id</p>
<p>
<b><code>special</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="special" data-endpoint="PUTproducts--product--special--special-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>product_special</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product_special" data-endpoint="PUTproducts--product--special--special-" data-component="url" required  hidden>
<br>
product_special_id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>product_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="product_id" data-endpoint="PUTproducts--product--special--special-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>customer_group_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="customer_group_id" data-endpoint="PUTproducts--product--special--special-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>domain</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="domain" data-endpoint="PUTproducts--product--special--special-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>priority</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="priority" data-endpoint="PUTproducts--product--special--special-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>price</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="price" data-endpoint="PUTproducts--product--special--special-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>date_start</code></b>&nbsp;&nbsp;<small>date</small>     <i>optional</i> &nbsp;
<input type="text" name="date_start" data-endpoint="PUTproducts--product--special--special-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>date_end</code></b>&nbsp;&nbsp;<small>date</small>     <i>optional</i> &nbsp;
<input type="text" name="date_end" data-endpoint="PUTproducts--product--special--special-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified resource from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/products/omnis/special/vel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/omnis/special/vel"
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
<div id="execution-results-DELETEproducts--product--special--special-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEproducts--product--special--special-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEproducts--product--special--special-"></code></pre>
</div>
<div id="execution-error-DELETEproducts--product--special--special-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEproducts--product--special--special-"></code></pre>
</div>
<form id="form-DELETEproducts--product--special--special-" data-method="DELETE" data-path="products/{product}/special/{special}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEproducts--product--special--special-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEproducts--product--special--special-" onclick="tryItOut('DELETEproducts--product--special--special-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEproducts--product--special--special-" onclick="cancelTryOut('DELETEproducts--product--special--special-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEproducts--product--special--special-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>products/{product}/special/{special}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="DELETEproducts--product--special--special-" data-component="url" required  hidden>
<br>
product_id</p>
<p>
<b><code>special</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="special" data-endpoint="DELETEproducts--product--special--special-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>product_special</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product_special" data-endpoint="DELETEproducts--product--special--special-" data-component="url" required  hidden>
<br>
product_special_id</p>
</form>



