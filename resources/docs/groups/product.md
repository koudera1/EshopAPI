# Product


## Display a listing of all products.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products"
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
"product_id":2400,
"category_id":202,
"category_id2":312,
"model":88396,
"sku":4015588883965,
"location":'',
"quantity":0,
"internal_quantity":1,
"stock_status_id":14,
"image":"data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
"manufacturer_id":6,
"shipping":1,
"price":1817.3554,
"tax_class_id": 20,
"date_available":"2019-05-29",
"weight":0.00,
"weight_class_id":1,
"length":0.00,
"width":0.00,
"height":0.00,
"measurement_class_id":1,
"status":1,
"date_added":'2019-05-29 10:28:48',
"date_modified":'2019-05-29 10:28:48',
"viewed":0,
"container_capacity":0,
"req_container":0,
"purchase_price":1099.0000,
"viewed_month":129,
"viewed_quartal":152,
"viewed_year":152,
"heureka":'Medisana PS 435',
"heureka_cat":'Bílé zboží | Malé spotřebiče | Péče o tělo | Zastřihovače',
"heureka_name":'Profesionální set fénu BaByliss PRO Rapido P1036E s příslušenstvím',
"warranty":24,
"sold_quartal":1,
"conversion_quartal":0.00658,
"free_shipping":1,
"domains":"",
"color1":"ffffff",
"color2":"000000",
"color3":"",
"marketing_domain":'',
"raw_name":'',
"zasilkovna_enabled":1,
"condition":1,
"erotic":0
]}
```
<div id="execution-results-GETproducts" hidden>
    <blockquote>Received response<span id="execution-response-status-GETproducts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETproducts"></code></pre>
</div>
<div id="execution-error-GETproducts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETproducts"></code></pre>
</div>
<form id="form-GETproducts" data-method="GET" data-path="products" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETproducts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETproducts" onclick="tryItOut('GETproducts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETproducts" onclick="cancelTryOut('GETproducts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETproducts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>products</code></b>
</p>
</form>


## Store a newly created product.




> Example request:

```bash
curl -X POST \
    "http://localhost/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"category_id":16,"category_id2":3,"model":"placeat","sku":"eius","location":"dolor","quantity":4,"internal_quantity":5,"stock_status_id":2,"image":"nisi","manufacturer_id":14,"shipping":20,"price":131.011678891,"tax_class_id":7,"date_available":"odio","weight":2205.3099613,"weight_class_id":18,"length":5315.74442,"width":7218,"height":19131.53619,"measurement_class_id":20,"status":15,"viewed":18,"container_capacity":13,"req_container":20,"purchase_price":769846.15,"viewed_month":8,"viewed_quartal":5,"viewed_year":7,"heureka":"ipsam","heureka_cat":"eius","heureka_name":"quia","warranty":19,"sold_quartal":6,"conversion_quartal":38.77,"free_shipping":7,"domains":"in","color1":"omnis","color2":"ducimus","color3":"laudantium","marketing_domain":"hic","raw_name":"eveniet","zasilkovna_enabled":18,"condition":3,"erotic":19,"language":"laborum","name":"natus","meta_description":"distinctio","meta_keywords":"omnis","description":"voluptatum","intro":"ab"}'

```

```javascript
const url = new URL(
    "http://localhost/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "category_id": 16,
    "category_id2": 3,
    "model": "placeat",
    "sku": "eius",
    "location": "dolor",
    "quantity": 4,
    "internal_quantity": 5,
    "stock_status_id": 2,
    "image": "nisi",
    "manufacturer_id": 14,
    "shipping": 20,
    "price": 131.011678891,
    "tax_class_id": 7,
    "date_available": "odio",
    "weight": 2205.3099613,
    "weight_class_id": 18,
    "length": 5315.74442,
    "width": 7218,
    "height": 19131.53619,
    "measurement_class_id": 20,
    "status": 15,
    "viewed": 18,
    "container_capacity": 13,
    "req_container": 20,
    "purchase_price": 769846.15,
    "viewed_month": 8,
    "viewed_quartal": 5,
    "viewed_year": 7,
    "heureka": "ipsam",
    "heureka_cat": "eius",
    "heureka_name": "quia",
    "warranty": 19,
    "sold_quartal": 6,
    "conversion_quartal": 38.77,
    "free_shipping": 7,
    "domains": "in",
    "color1": "omnis",
    "color2": "ducimus",
    "color3": "laudantium",
    "marketing_domain": "hic",
    "raw_name": "eveniet",
    "zasilkovna_enabled": 18,
    "condition": 3,
    "erotic": 19,
    "language": "laborum",
    "name": "natus",
    "meta_description": "distinctio",
    "meta_keywords": "omnis",
    "description": "voluptatum",
    "intro": "ab"
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
    "product_id": 3332
}
```
<div id="execution-results-POSTproducts" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTproducts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTproducts"></code></pre>
</div>
<div id="execution-error-POSTproducts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTproducts"></code></pre>
</div>
<form id="form-POSTproducts" data-method="POST" data-path="products" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTproducts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTproducts" onclick="tryItOut('POSTproducts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTproducts" onclick="cancelTryOut('POSTproducts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTproducts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>products</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>category_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="category_id" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>category_id2</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="category_id2" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>model</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="model" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>sku</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="sku" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>location</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="location" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>quantity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="quantity" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>internal_quantity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="internal_quantity" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>stock_status_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="stock_status_id" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="image" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>manufacturer_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="manufacturer_id" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>shipping</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="shipping" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>price</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="price" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>tax_class_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="tax_class_id" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>date_available</code></b>&nbsp;&nbsp;<small>date</small>  &nbsp;
<input type="text" name="date_available" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>weight</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="weight" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>weight_class_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="weight_class_id" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>length</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="length" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>width</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="width" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>height</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="height" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>measurement_class_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="measurement_class_id" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>container_capacity</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="container_capacity" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>req_container</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="req_container" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>purchase_price</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="purchase_price" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed_month</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed_month" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed_quartal</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed_quartal" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed_year</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed_year" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>heureka</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="heureka" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>heureka_cat</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="heureka_cat" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>heureka_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="heureka_name" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>warranty</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="warranty" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>sold_quartal</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="sold_quartal" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>conversion_quartal</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
<input type="number" name="conversion_quartal" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>free_shipping</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="free_shipping" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>domains</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="domains" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>color1</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="color1" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>color2</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="color2" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>color3</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="color3" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>marketing_domain</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="marketing_domain" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>raw_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="raw_name" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>zasilkovna_enabled</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="zasilkovna_enabled" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>condition</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="condition" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>erotic</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="erotic" data-endpoint="POSTproducts" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>language</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="language" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>meta_description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_description" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>meta_keywords</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_keywords" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="description" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>intro</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="intro" data-endpoint="POSTproducts" data-component="body" required  hidden>
<br>
</p>

</form>


## Display the specified product.




> Example request:

```bash
curl -X GET \
    -G "http://localhost/products/2408" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/2408"
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
"product_id":2400,
"category_id":202,
"category_id2":312,
"model":88396,
"sku":4015588883965,
"location":'',
"quantity":0,
"internal_quantity":1,
"stock_status_id":14,
"image":"data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
"manufacturer_id":6,
"shipping":1,
"price":1817.3554,
"tax_class_id": 20,
"date_available":"2019-05-29",
"weight":0.00,
"weight_class_id":1,
"length":0.00,
"width":0.00,
"height":0.00,
"measurement_class_id":1,
"status":1,
"date_added":'2019-05-29 10:28:48',
"date_modified":'2019-05-29 10:28:48',
"viewed":0,
"container_capacity":0,
"req_container":0,
"purchase_price":1099.0000,
"viewed_month":129,
"viewed_quartal":152,
"viewed_year":152,
"heureka":'Medisana PS 435',
"heureka_cat":'Bílé zboží | Malé spotřebiče | Péče o tělo | Zastřihovače',
"heureka_name":'Profesionální set fénu BaByliss PRO Rapido P1036E s příslušenstvím'
"warranty":24,
"sold_quartal":1,
"conversion_quartal":0.00658,
"free_shipping":1,
"domains":"",
"color1":"ffffff",
"color2":"000000",
"color3":"",
"marketing_domain":'',
"raw_name":'',
"zasilkovna_enabled":1,
"condition":1,
"erotic":0
}
```
<div id="execution-results-GETproducts--product-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETproducts--product-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETproducts--product-"></code></pre>
</div>
<div id="execution-error-GETproducts--product-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETproducts--product-"></code></pre>
</div>
<form id="form-GETproducts--product-" data-method="GET" data-path="products/{product}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETproducts--product-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETproducts--product-" onclick="tryItOut('GETproducts--product-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETproducts--product-" onclick="cancelTryOut('GETproducts--product-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETproducts--product-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>products/{product}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="GETproducts--product-" data-component="url" required  hidden>
<br>
product id</p>
</form>


## Update the specified product in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/products/saepe" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"category_id":15,"category_id2":9,"model":"iure","sku":2,"location":"odio","quantity":10,"internal_quantity":15,"stock_status_id":11,"image":"porro","manufacturer_id":15,"shipping":10,"price":140.83,"tax_class_id":20,"date_available":"aut","weight":2.4199661,"weight_class_id":18,"length":52.348135,"width":5726740.08316,"height":96822357,"measurement_class_id":1,"status":17,"viewed":18,"container_capacity":7,"req_capacity":12,"req_container":12,"purchase_price":29.827,"viewed_month":14,"viewed_quartal":12,"viewed_year":7,"heureka":14,"heureka_cat":10,"heureka_name":5,"warranty":11,"sold_quartal":14,"conversion_quartal":9,"free_shipping":16,"domains":"id","color1":"ut","color2":"at","color3":"sit","marketing_damain":"deserunt","raw_name":"ipsum","zasilkovna_enabled":17,"condition":11,"erotic":3}'

```

```javascript
const url = new URL(
    "http://localhost/products/saepe"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "category_id": 15,
    "category_id2": 9,
    "model": "iure",
    "sku": 2,
    "location": "odio",
    "quantity": 10,
    "internal_quantity": 15,
    "stock_status_id": 11,
    "image": "porro",
    "manufacturer_id": 15,
    "shipping": 10,
    "price": 140.83,
    "tax_class_id": 20,
    "date_available": "aut",
    "weight": 2.4199661,
    "weight_class_id": 18,
    "length": 52.348135,
    "width": 5726740.08316,
    "height": 96822357,
    "measurement_class_id": 1,
    "status": 17,
    "viewed": 18,
    "container_capacity": 7,
    "req_capacity": 12,
    "req_container": 12,
    "purchase_price": 29.827,
    "viewed_month": 14,
    "viewed_quartal": 12,
    "viewed_year": 7,
    "heureka": 14,
    "heureka_cat": 10,
    "heureka_name": 5,
    "warranty": 11,
    "sold_quartal": 14,
    "conversion_quartal": 9,
    "free_shipping": 16,
    "domains": "id",
    "color1": "ut",
    "color2": "at",
    "color3": "sit",
    "marketing_damain": "deserunt",
    "raw_name": "ipsum",
    "zasilkovna_enabled": 17,
    "condition": 11,
    "erotic": 3
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
    "location": true,
    "shipping": true
}
```
<div id="execution-results-PUTproducts--product-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTproducts--product-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTproducts--product-"></code></pre>
</div>
<div id="execution-error-PUTproducts--product-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTproducts--product-"></code></pre>
</div>
<form id="form-PUTproducts--product-" data-method="PUT" data-path="products/{product}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTproducts--product-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTproducts--product-" onclick="tryItOut('PUTproducts--product-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTproducts--product-" onclick="cancelTryOut('PUTproducts--product-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTproducts--product-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>products/{product}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>products/{product}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="PUTproducts--product-" data-component="url" required  hidden>
<br>
product id</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>category_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="category_id" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>category_id2</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="category_id2" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>model</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="model" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>sku</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="sku" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>location</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="location" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>quantity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="quantity" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>internal_quantity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="internal_quantity" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>stock_status_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="stock_status_id" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>manufacturer_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="manufacturer_id" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>shipping</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="shipping" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>price</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="price" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>tax_class_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="tax_class_id" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>date_available</code></b>&nbsp;&nbsp;<small>date</small>     <i>optional</i> &nbsp;
<input type="text" name="date_available" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>weight</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="weight" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>weight_class_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="weight_class_id" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>length</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="length" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>width</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="width" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>height</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="height" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>measurement_class_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="measurement_class_id" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>container_capacity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="container_capacity" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>req_capacity</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="req_capacity" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>req_container</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="req_container" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>purchase_price</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
<input type="number" name="purchase_price" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed_month</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed_month" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed_quartal</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed_quartal" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>viewed_year</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="viewed_year" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>heureka</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="heureka" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>heureka_cat</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="heureka_cat" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>heureka_name</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="heureka_name" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>warranty</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="warranty" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>sold_quartal</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="sold_quartal" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>conversion_quartal</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="conversion_quartal" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>free_shipping</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="free_shipping" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>domains</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="domains" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>color1</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="color1" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>color2</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="color2" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>color3</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="color3" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>marketing_damain</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="marketing_damain" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>raw_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="raw_name" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>zasilkovna_enabled</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="zasilkovna_enabled" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>condition</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="condition" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>erotic</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="erotic" data-endpoint="PUTproducts--product-" data-component="body"  hidden>
<br>
</p>

</form>


## Remove the specified product from storage.




> Example request:

```bash
curl -X DELETE \
    "http://localhost/products/2408" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/2408"
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
<div id="execution-results-DELETEproducts--product-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEproducts--product-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEproducts--product-"></code></pre>
</div>
<div id="execution-error-DELETEproducts--product-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEproducts--product-"></code></pre>
</div>
<form id="form-DELETEproducts--product-" data-method="DELETE" data-path="products/{product}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEproducts--product-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEproducts--product-" onclick="tryItOut('DELETEproducts--product-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEproducts--product-" onclick="cancelTryOut('DELETEproducts--product-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEproducts--product-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>products/{product}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>product</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="product" data-endpoint="DELETEproducts--product-" data-component="url" required  hidden>
<br>
product id</p>
</form>



