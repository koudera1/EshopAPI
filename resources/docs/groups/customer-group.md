# Customer_group


## Display a listing of all customer groups.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/customer_groups" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/customer_groups"
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
"customer_group_id":2,
"name":"sleva5procent"
]}
```
<div id="execution-results-GETcustomer_groups" hidden>
    <blockquote>Received response<span id="execution-response-status-GETcustomer_groups"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer_groups"></code></pre>
</div>
<div id="execution-error-GETcustomer_groups" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer_groups"></code></pre>
</div>
<form id="form-GETcustomer_groups" data-method="GET" data-path="customer_groups" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETcustomer_groups', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETcustomer_groups" onclick="tryItOut('GETcustomer_groups');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETcustomer_groups" onclick="cancelTryOut('GETcustomer_groups');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETcustomer_groups" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>customer_groups</code></b>
</p>
</form>


## Store a newly created customer group in storage.




> Example request:

```bash
curl -X POST \
    "http://localhost/customer_groups" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"ducimus"}'

```

```javascript
const url = new URL(
    "http://localhost/customer_groups"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ducimus"
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
"customer_group_id":2,
}
```
<div id="execution-results-POSTcustomer_groups" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTcustomer_groups"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer_groups"></code></pre>
</div>
<div id="execution-error-POSTcustomer_groups" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer_groups"></code></pre>
</div>
<form id="form-POSTcustomer_groups" data-method="POST" data-path="customer_groups" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTcustomer_groups', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTcustomer_groups" onclick="tryItOut('POSTcustomer_groups');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTcustomer_groups" onclick="cancelTryOut('POSTcustomer_groups');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTcustomer_groups" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>customer_groups</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTcustomer_groups" data-component="body" required  hidden>
<br>
</p>

</form>


## Display the specified customer group.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/customer_groups/vero" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/customer_groups/vero"
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
    "customer_group_id": 2,
    "name": "sleva5procent"
}
```
<div id="execution-results-GETcustomer_groups--customer_group-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETcustomer_groups--customer_group-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer_groups--customer_group-"></code></pre>
</div>
<div id="execution-error-GETcustomer_groups--customer_group-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer_groups--customer_group-"></code></pre>
</div>
<form id="form-GETcustomer_groups--customer_group-" data-method="GET" data-path="customer_groups/{customer_group}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETcustomer_groups--customer_group-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETcustomer_groups--customer_group-" onclick="tryItOut('GETcustomer_groups--customer_group-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETcustomer_groups--customer_group-" onclick="cancelTryOut('GETcustomer_groups--customer_group-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETcustomer_groups--customer_group-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>customer_groups/{customer_group}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>customer_group</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="customer_group" data-endpoint="GETcustomer_groups--customer_group-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>customer</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="customer" data-endpoint="GETcustomer_groups--customer_group-" data-component="url"  hidden>
<br>
group required customer group id</p>
</form>


## Update the specified customer group in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/customer_groups/quibusdam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"sunt"}'

```

```javascript
const url = new URL(
    "http://localhost/customer_groups/quibusdam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "sunt"
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTcustomer_groups--customer_group-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTcustomer_groups--customer_group-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTcustomer_groups--customer_group-"></code></pre>
</div>
<div id="execution-error-PUTcustomer_groups--customer_group-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTcustomer_groups--customer_group-"></code></pre>
</div>
<form id="form-PUTcustomer_groups--customer_group-" data-method="PUT" data-path="customer_groups/{customer_group}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTcustomer_groups--customer_group-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTcustomer_groups--customer_group-" onclick="tryItOut('PUTcustomer_groups--customer_group-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTcustomer_groups--customer_group-" onclick="cancelTryOut('PUTcustomer_groups--customer_group-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTcustomer_groups--customer_group-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>customer_groups/{customer_group}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>customer_groups/{customer_group}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>customer_group</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="customer_group" data-endpoint="PUTcustomer_groups--customer_group-" data-component="url" required  hidden>
<br>
</p>
<p>
<b><code>customer</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="customer" data-endpoint="PUTcustomer_groups--customer_group-" data-component="url"  hidden>
<br>
group required customer group id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="name" data-endpoint="PUTcustomer_groups--customer_group-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified resource from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/customer_groups/exercitationem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/customer_groups/exercitationem"
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


<div id="execution-results-DELETEcustomer_groups--customer_group-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEcustomer_groups--customer_group-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEcustomer_groups--customer_group-"></code></pre>
</div>
<div id="execution-error-DELETEcustomer_groups--customer_group-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEcustomer_groups--customer_group-"></code></pre>
</div>
<form id="form-DELETEcustomer_groups--customer_group-" data-method="DELETE" data-path="customer_groups/{customer_group}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEcustomer_groups--customer_group-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEcustomer_groups--customer_group-" onclick="tryItOut('DELETEcustomer_groups--customer_group-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEcustomer_groups--customer_group-" onclick="cancelTryOut('DELETEcustomer_groups--customer_group-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEcustomer_groups--customer_group-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>customer_groups/{customer_group}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>customer_group</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="customer_group" data-endpoint="DELETEcustomer_groups--customer_group-" data-component="url" required  hidden>
<br>
</p>
</form>



