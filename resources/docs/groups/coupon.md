# Coupon


## Display a listing of all coupons.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/coupons" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/coupons"
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
"coupon_id":1,
"domain":"www.muj-tangleteezer.cz",
"code":"15xtangleteezer",
"type":"P",
"discount":15.0000,
"logged":0,
"shipping":1,
"total":0.0000,
"date_start":"2017-08-01",
"date_end":"2027-08-01",
"uses_total":9999999,
"uses_customer":9999999,
"status":1,
"date_added":""
]}
```
<div id="execution-results-GETcoupons" hidden>
    <blockquote>Received response<span id="execution-response-status-GETcoupons"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETcoupons"></code></pre>
</div>
<div id="execution-error-GETcoupons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcoupons"></code></pre>
</div>
<form id="form-GETcoupons" data-method="GET" data-path="coupons" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETcoupons', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETcoupons" onclick="tryItOut('GETcoupons');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETcoupons" onclick="cancelTryOut('GETcoupons');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETcoupons" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>coupons</code></b>
</p>
</form>


## Store a newly created coupon in storage.




> Example request:

```bash
curl -X POST \
    "http://localhost/coupons" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"coupon_id":17,"domain":"est","code":"ut","type":"rerum","discount":301.71970689,"logged":17,"shipping":4,"total":240235162.4446,"date_start":"velit","date_end":"dolores","uses_total":10,"uses_customer":15,"status":5,"date_added":"nam","language_id":4,"name":"ipsum","description":"quas"}'

```

```javascript
const url = new URL(
    "http://localhost/coupons"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "coupon_id": 17,
    "domain": "est",
    "code": "ut",
    "type": "rerum",
    "discount": 301.71970689,
    "logged": 17,
    "shipping": 4,
    "total": 240235162.4446,
    "date_start": "velit",
    "date_end": "dolores",
    "uses_total": 10,
    "uses_customer": 15,
    "status": 5,
    "date_added": "nam",
    "language_id": 4,
    "name": "ipsum",
    "description": "quas"
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
    "coupon_id": 2
}
```
<div id="execution-results-POSTcoupons" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTcoupons"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTcoupons"></code></pre>
</div>
<div id="execution-error-POSTcoupons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcoupons"></code></pre>
</div>
<form id="form-POSTcoupons" data-method="POST" data-path="coupons" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTcoupons', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTcoupons" onclick="tryItOut('POSTcoupons');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTcoupons" onclick="cancelTryOut('POSTcoupons');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTcoupons" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>coupons</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>coupon_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="coupon_id" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>domain</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="domain" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>code</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="code" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="type" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>discount</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
<input type="number" name="discount" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>logged</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="logged" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>shipping</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="shipping" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>total</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
<input type="number" name="total" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>date_start</code></b>&nbsp;&nbsp;<small>date</small>  &nbsp;
<input type="text" name="date_start" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>date_end</code></b>&nbsp;&nbsp;<small>date</small>  &nbsp;
<input type="text" name="date_end" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>uses_total</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="uses_total" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>uses_customer</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="uses_customer" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="status" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>date_added</code></b>&nbsp;&nbsp;<small>date</small>  &nbsp;
<input type="text" name="date_added" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>language_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="language_id" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="description" data-endpoint="POSTcoupons" data-component="body" required  hidden>
<br>
</p>

</form>


## Display the specified coupon.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/coupons/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/coupons/2"
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
    "coupon_id": 1,
    "domain": "www.muj-tangleteezer.cz",
    "code": "15xtangleteezer",
    "type": "P",
    "discount": 15,
    "logged": 0,
    "shipping": 1,
    "total": 0,
    "date_start": "2017-08-01",
    "date_end": "2027-08-01",
    "uses_total": 9999999,
    "uses_customer": 9999999,
    "status": 1,
    "date_added": ""
}
```
<div id="execution-results-GETcoupons--coupon-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETcoupons--coupon-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETcoupons--coupon-"></code></pre>
</div>
<div id="execution-error-GETcoupons--coupon-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcoupons--coupon-"></code></pre>
</div>
<form id="form-GETcoupons--coupon-" data-method="GET" data-path="coupons/{coupon}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETcoupons--coupon-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETcoupons--coupon-" onclick="tryItOut('GETcoupons--coupon-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETcoupons--coupon-" onclick="cancelTryOut('GETcoupons--coupon-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETcoupons--coupon-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>coupons/{coupon}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>coupon</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="coupon" data-endpoint="GETcoupons--coupon-" data-component="url" required  hidden>
<br>
coupon id</p>
</form>


## Update the specified coupon in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/coupons/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"domain":"explicabo","code":"minus","type":"voluptas","discount":135.226300507,"logged":3,"shipping":16,"total":0.688,"date_start":"architecto","date_end":"asperiores","uses_total":7,"uses_customer":3,"status":9,"name":"aspernatur","description":"et"}'

```

```javascript
const url = new URL(
    "http://localhost/coupons/2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "domain": "explicabo",
    "code": "minus",
    "type": "voluptas",
    "discount": 135.226300507,
    "logged": 3,
    "shipping": 16,
    "total": 0.688,
    "date_start": "architecto",
    "date_end": "asperiores",
    "uses_total": 7,
    "uses_customer": 3,
    "status": 9,
    "name": "aspernatur",
    "description": "et"
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
    "code": true,
    "type": true
}
```
<div id="execution-results-PUTcoupons--coupon-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTcoupons--coupon-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTcoupons--coupon-"></code></pre>
</div>
<div id="execution-error-PUTcoupons--coupon-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTcoupons--coupon-"></code></pre>
</div>
<form id="form-PUTcoupons--coupon-" data-method="PUT" data-path="coupons/{coupon}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTcoupons--coupon-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTcoupons--coupon-" onclick="tryItOut('PUTcoupons--coupon-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTcoupons--coupon-" onclick="cancelTryOut('PUTcoupons--coupon-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTcoupons--coupon-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>coupons/{coupon}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>coupons/{coupon}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>coupon</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="coupon" data-endpoint="PUTcoupons--coupon-" data-component="url" required  hidden>
<br>
coupon id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>domain</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="domain" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>code</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="code" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>type</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="type" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>discount</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="discount" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>logged</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="logged" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="shipping" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>total</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="total" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>date_start</code></b>&nbsp;&nbsp;<small>date</small>     <i>optional</i> &nbsp;
<input type="text" name="date_start" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>date_end</code></b>&nbsp;&nbsp;<small>date</small>     <i>optional</i> &nbsp;
<input type="text" name="date_end" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>uses_total</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="uses_total" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>uses_customer</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="uses_customer" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="name" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>description</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="description" data-endpoint="PUTcoupons--coupon-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified coupon from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/coupons/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/coupons/2"
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

{true}
```
<div id="execution-results-DELETEcoupons--coupon-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEcoupons--coupon-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEcoupons--coupon-"></code></pre>
</div>
<div id="execution-error-DELETEcoupons--coupon-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEcoupons--coupon-"></code></pre>
</div>
<form id="form-DELETEcoupons--coupon-" data-method="DELETE" data-path="coupons/{coupon}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEcoupons--coupon-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEcoupons--coupon-" onclick="tryItOut('DELETEcoupons--coupon-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEcoupons--coupon-" onclick="cancelTryOut('DELETEcoupons--coupon-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEcoupons--coupon-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>coupons/{coupon}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>coupon</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="coupon" data-endpoint="DELETEcoupons--coupon-" data-component="url" required  hidden>
<br>
coupon id</p>
</form>



