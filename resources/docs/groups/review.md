# Review


## Display a listing of all reviews.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/reviews" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/reviews"
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
"review_id":2,
"product_id":66,
"customer_id":0,
"author":'Jan',
"text":'Super.',
"rating":5,
"status":1,
"date_added":"2012-01-28 17:00:18",
"date_modified":"2012-01-28 17:00:18"
]}
```
<div id="execution-results-GETreviews" hidden>
    <blockquote>Received response<span id="execution-response-status-GETreviews"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETreviews"></code></pre>
</div>
<div id="execution-error-GETreviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETreviews"></code></pre>
</div>
<form id="form-GETreviews" data-method="GET" data-path="reviews" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETreviews', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETreviews" onclick="tryItOut('GETreviews');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETreviews" onclick="cancelTryOut('GETreviews');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETreviews" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>reviews</code></b>
</p>
</form>


## Store a newly created review in storage.




> Example request:

```bash
curl -X POST \
    "http://localhost/reviews" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"product_id":2,"customer_id":5,"author":"'Kamila'","text":"\"Je to moc dobr\u00e9.\"","rating":5,"status":1}'

```

```javascript
const url = new URL(
    "http://localhost/reviews"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 2,
    "customer_id": 5,
    "author": "'Kamila'",
    "text": "\"Je to moc dobr\u00e9.\"",
    "rating": 5,
    "status": 1
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
"review_id":2,
}
```
<div id="execution-results-POSTreviews" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTreviews"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTreviews"></code></pre>
</div>
<div id="execution-error-POSTreviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTreviews"></code></pre>
</div>
<form id="form-POSTreviews" data-method="POST" data-path="reviews" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTreviews', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTreviews" onclick="tryItOut('POSTreviews');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTreviews" onclick="cancelTryOut('POSTreviews');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTreviews" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>reviews</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>product_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="product_id" data-endpoint="POSTreviews" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>customer_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="customer_id" data-endpoint="POSTreviews" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>author</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="author" data-endpoint="POSTreviews" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>text</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="text" data-endpoint="POSTreviews" data-component="body" required  hidden>
<br>
ip address</p>
<p>
<b><code>rating</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="rating" data-endpoint="POSTreviews" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="status" data-endpoint="POSTreviews" data-component="body" required  hidden>
<br>
</p>

</form>


## Display the specified review.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/reviews/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/reviews/2"
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
"review_id":2,
"product_id":66,
"customer_id":0,
"author":'Jan',
"text":'Super.',
"rating":5,
"status":1,
"date_added":"2012-01-28 17:00:18",
"date_modified":"2012-01-28 17:00:18"
}
```
<div id="execution-results-GETreviews--review-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETreviews--review-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETreviews--review-"></code></pre>
</div>
<div id="execution-error-GETreviews--review-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETreviews--review-"></code></pre>
</div>
<form id="form-GETreviews--review-" data-method="GET" data-path="reviews/{review}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETreviews--review-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETreviews--review-" onclick="tryItOut('GETreviews--review-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETreviews--review-" onclick="cancelTryOut('GETreviews--review-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETreviews--review-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>reviews/{review}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>review</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="review" data-endpoint="GETreviews--review-" data-component="url" required  hidden>
<br>
review id</p>
</form>


## Update the specified review in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/reviews/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"author":"\"Jaroslav\"","text":"est","rating":12}'

```

```javascript
const url = new URL(
    "http://localhost/reviews/2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "author": "\"Jaroslav\"",
    "text": "est",
    "rating": 12
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
    "author": true,
    "text": true
}
```
<div id="execution-results-PUTreviews--review-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTreviews--review-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTreviews--review-"></code></pre>
</div>
<div id="execution-error-PUTreviews--review-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTreviews--review-"></code></pre>
</div>
<form id="form-PUTreviews--review-" data-method="PUT" data-path="reviews/{review}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTreviews--review-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTreviews--review-" onclick="tryItOut('PUTreviews--review-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTreviews--review-" onclick="cancelTryOut('PUTreviews--review-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTreviews--review-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>reviews/{review}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>reviews/{review}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>review</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="review" data-endpoint="PUTreviews--review-" data-component="url" required  hidden>
<br>
review id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>author</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="author" data-endpoint="PUTreviews--review-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>text</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="text" data-endpoint="PUTreviews--review-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>rating</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="rating" data-endpoint="PUTreviews--review-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified resource from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/reviews/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/reviews/2"
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
<div id="execution-results-DELETEreviews--review-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEreviews--review-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEreviews--review-"></code></pre>
</div>
<div id="execution-error-DELETEreviews--review-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEreviews--review-"></code></pre>
</div>
<form id="form-DELETEreviews--review-" data-method="DELETE" data-path="reviews/{review}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEreviews--review-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEreviews--review-" onclick="tryItOut('DELETEreviews--review-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEreviews--review-" onclick="cancelTryOut('DELETEreviews--review-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEreviews--review-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>reviews/{review}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>review</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="review" data-endpoint="DELETEreviews--review-" data-component="url" required  hidden>
<br>
review id</p>
</form>



