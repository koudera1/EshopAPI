---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Order


<!-- START_04709dac110fe4467fa41969618a5144 -->
## Display the addresses of the order.

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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}/addresses`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_04709dac110fe4467fa41969618a5144 -->

<!-- START_47d0dc0ed8f2a6eb05b987240ab000c8 -->
## Display the price of the specified order.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/price" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/price"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}/price`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_47d0dc0ed8f2a6eb05b987240ab000c8 -->

<!-- START_d0e67dad7ba8986d9e306ce54f5f58d5 -->
## Display all shipping methods.

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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}/shipping_methods`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_d0e67dad7ba8986d9e306ce54f5f58d5 -->

<!-- START_52ffb86b2a1361c0c116b38bff18965a -->
## Display all payment methods.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/payment_methods" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/payment_methods"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    "Na dobírku",
    "Platba kartou",
    "Bankovní převod",
    "Hotově"
]
```

### HTTP Request
`GET payment_methods`


<!-- END_52ffb86b2a1361c0c116b38bff18965a -->

<!-- START_49f3e3734a4f8f5ff820ae661826a3ad -->
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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
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

### HTTP Request
`GET order_statuses`


<!-- END_49f3e3734a4f8f5ff820ae661826a3ad -->

<!-- START_3181dd1bf09870a5347f4423108cbeee -->
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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT orders/{order}/invoice`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_3181dd1bf09870a5347f4423108cbeee -->

<!-- START_b5c3d96b6f223c292187fb2933f21034 -->
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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders`


<!-- END_b5c3d96b6f223c292187fb2933f21034 -->

<!-- START_ec29d74de87750d93ffc5c2316881ba2 -->
## Create a new order when a customer adds sth to his cart.

> Example request:

```bash
curl -X POST \
    "http://localhost/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"domain":"\"www.moje_medisana.cz\"","customer_id":"0","language":"\"\u010ce\u0161tina\"","ip":"\"165.154.213.546\"","referrer":"\"Google\"","product_id":"2400","quantity_int":"1","quantity_ext":"1","quantity":"2"}'

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
    "quantity_int": "1",
    "quantity_ext": "1",
    "quantity": "2"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "order_id": 35022,
    "order_product_id": 3332
}
```

### HTTP Request
`POST orders`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `domain` | required |  optional  | 
        `customer_id` | required |  optional  | 
        `language` | required |  optional  | 
        `ip` | required |  optional  | ip address
        `referrer` | required |  optional  | 
        `product_id` | required |  optional  | 
        `quantity_int` | required |  optional  | The number of products from the order in the internal stock.
        `quantity_ext` | required |  optional  | The number of products from the order in an external stock.
        `quantity` | required |  optional  | The quantity of products.
    
<!-- END_ec29d74de87750d93ffc5c2316881ba2 -->

<!-- START_8ebabf804d4d9c276a852395bcb61678 -->
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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_8ebabf804d4d9c276a852395bcb61678 -->

<!-- START_9144c4cefdb1ada60d895a1766f1710f -->
## Update the specified order in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/35022" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"domain":"\"www.stylka.cz\"","currency":"deleniti","language":"quas","firstname":"ut","lastname":"eaque","company":"rem","comment":"nam","order_status":"\"Nevy\u0159\u00edzeno.\"","shipping_method":"\"Z\u00e1silkovna\"","payment_status":1,"referrer":"numquam","agree_gdpr":1,"payment_method":"qui","email":"non","telephone":"rerum","fax":"repudiandae","regNum":"ab","ip":"corrupti","reason":"\"Reklamace\"","wrong_order_id":4,"competition":9,"euVAT":18,"viewed":0,"shipping_firstname":"ab","shipping_lastname":"illo","shipping_company":"necessitatibus","shipping_address_1":"enim","shipping_address_2":"magnam","shipping_city":"fuga","shipping_postcode":"ut","shipping_zone":"voluptas","shipping_zone_id":13,"shipping_country":"minus","shipping_country_id":11,"shipping_address_format":"molestiae","payment_firstname":"voluptatem","payment_lastname":"molestias","payment_company":"cum","payment_address_1":"modi","payment_address_2":"debitis","payment_city":"ullam","payment_postcode":"nam","payment_zone":"rerum","payment_zone_id":20,"payment_country":"facilis","payment_country_id":7,"payment_address_format":"quia"}'

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
    "domain": "\"www.stylka.cz\"",
    "currency": "deleniti",
    "language": "quas",
    "firstname": "ut",
    "lastname": "eaque",
    "company": "rem",
    "comment": "nam",
    "order_status": "\"Nevy\u0159\u00edzeno.\"",
    "shipping_method": "\"Z\u00e1silkovna\"",
    "payment_status": 1,
    "referrer": "numquam",
    "agree_gdpr": 1,
    "payment_method": "qui",
    "email": "non",
    "telephone": "rerum",
    "fax": "repudiandae",
    "regNum": "ab",
    "ip": "corrupti",
    "reason": "\"Reklamace\"",
    "wrong_order_id": 4,
    "competition": 9,
    "euVAT": 18,
    "viewed": 0,
    "shipping_firstname": "ab",
    "shipping_lastname": "illo",
    "shipping_company": "necessitatibus",
    "shipping_address_1": "enim",
    "shipping_address_2": "magnam",
    "shipping_city": "fuga",
    "shipping_postcode": "ut",
    "shipping_zone": "voluptas",
    "shipping_zone_id": 13,
    "shipping_country": "minus",
    "shipping_country_id": 11,
    "shipping_address_format": "molestiae",
    "payment_firstname": "voluptatem",
    "payment_lastname": "molestias",
    "payment_company": "cum",
    "payment_address_1": "modi",
    "payment_address_2": "debitis",
    "payment_city": "ullam",
    "payment_postcode": "nam",
    "payment_zone": "rerum",
    "payment_zone_id": 20,
    "payment_country": "facilis",
    "payment_country_id": 7,
    "payment_address_format": "quia"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "domain": true,
    "currency": true
}
```

### HTTP Request
`PUT orders/{order}`

`PATCH orders/{order}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `domain` | string |  optional  | 
        `currency` | string |  optional  | 
        `language` | string |  optional  | 
        `firstname` | string |  optional  | 
        `lastname` | string |  optional  | 
        `company` | string |  optional  | 
        `comment` | string |  optional  | The comment written by the customer.
        `order_status` | string |  optional  | 
        `shipping_method` | string |  optional  | 
        `payment_status` | integer |  optional  | Whether the order was paid.
        `referrer` | string |  optional  | The source website where the customer has come from.
        `agree_gdpr` | integer |  optional  | Whether the customer agrees with gdpr policy.
        `payment_method` | string |  optional  | 
        `email` | string |  optional  | In Czech language DIČO.
        `telephone` | string |  optional  | 
        `fax` | string |  optional  | 
        `regNum` | string |  optional  | In Czech language IČO.
        `ip` | string |  optional  | 
        `reason` | string |  optional  | 
        `wrong_order_id` | integer |  optional  | 
        `competition` | integer |  optional  | 
        `euVAT` | integer |  optional  | 
        `viewed` | integer |  optional  | Whether the order has been viewed.
        `shipping_firstname` | string |  optional  | 
        `shipping_lastname` | string |  optional  | 
        `shipping_company` | string |  optional  | 
        `shipping_address_1` | string |  optional  | 
        `shipping_address_2` | string |  optional  | 
        `shipping_city` | string |  optional  | 
        `shipping_postcode` | string |  optional  | 
        `shipping_zone` | string |  optional  | 
        `shipping_zone_id` | integer |  optional  | 
        `shipping_country` | string |  optional  | 
        `shipping_country_id` | integer |  optional  | 
        `shipping_address_format` | string |  optional  | 
        `payment_firstname` | string |  optional  | 
        `payment_lastname` | string |  optional  | 
        `payment_company` | string |  optional  | 
        `payment_address_1` | string |  optional  | 
        `payment_address_2` | string |  optional  | 
        `payment_city` | string |  optional  | 
        `payment_postcode` | string |  optional  | 
        `payment_zone` | string |  optional  | 
        `payment_zone_id` | integer |  optional  | 
        `payment_country` | string |  optional  | 
        `payment_country_id` | integer |  optional  | 
        `payment_address_format` | string |  optional  | 
    
<!-- END_9144c4cefdb1ada60d895a1766f1710f -->

<!-- START_29c8f0bec78089caa3791b727dc038b0 -->
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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
true
```

### HTTP Request
`DELETE orders/{order}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_29c8f0bec78089caa3791b727dc038b0 -->

#Order_product


<!-- START_482d6402a8d3d8e7bddbc45e199046fc -->
## Display a listing of ordered products.

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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}/products`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_482d6402a8d3d8e7bddbc45e199046fc -->

<!-- START_4093542d31870cbc90a118b97700f3a0 -->
## Store a newly created ordered product in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/orders/35022/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"product_id":10,"name":"qui","tax":5,"quantity":18,"sort_order":15,"is_transfer":19,"is_action":3,"gift":12}'

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
    "product_id": 10,
    "name": "qui",
    "tax": 5,
    "quantity": 18,
    "sort_order": 15,
    "is_transfer": 19,
    "is_action": 3,
    "gift": 12
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "order_product_id": 3332
}
```

### HTTP Request
`POST orders/{order}/products`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `product_id` | integer |  required  | 
        `name` | string |  required  | 
        `tax` | integer |  optional  | 
        `quantity` | integer |  optional  | 
        `sort_order` | integer |  optional  | 
        `is_transfer` | integer |  optional  | 
        `is_action` | integer |  optional  | 
        `gift` | integer |  optional  | 
    
<!-- END_4093542d31870cbc90a118b97700f3a0 -->

<!-- START_9109231d52e1a9d8cf67cd38dcd82555 -->
## Display the specified ordered product.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/35022/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET orders/{order}/products/{product}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id
    `order_product` |  required  | order product id

<!-- END_9109231d52e1a9d8cf67cd38dcd82555 -->

<!-- START_7639003057f1b85eb5e85b5c7da2eac0 -->
## Update the specified ordered product in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/35022/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT orders/{order}/products/{product}`

`PATCH orders/{order}/products/{product}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id
    `order_product` |  required  | order product id

<!-- END_7639003057f1b85eb5e85b5c7da2eac0 -->

<!-- START_7d869265e8ffb7465c1cba8711f9d7b5 -->
## Remove the specified ordered product from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/orders/35022/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
true
```

### HTTP Request
`DELETE orders/{order}/products/{product}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id
    `order_product` |  required  | order product id

<!-- END_7d869265e8ffb7465c1cba8711f9d7b5 -->

#Package


<!-- START_3624998484888256a7286facbc228ec7 -->
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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}/packages`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_3624998484888256a7286facbc228ec7 -->

<!-- START_bb21b6865e90c5d9acab1bbd53cb3bc3 -->
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
    -d '{"cod":816.6,"b2c":19,"routing_id":7,"phone":"nihil","driver_note":"numquam","recipient_note":"deleniti","source":18,"gar":13,"package_order":14,"commercial":6,"service":"doloribus","weight":12613.63}'

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
    "cod": 816.6,
    "b2c": 19,
    "routing_id": 7,
    "phone": "nihil",
    "driver_note": "numquam",
    "recipient_note": "deleniti",
    "source": 18,
    "gar": 13,
    "package_order": 14,
    "commercial": 6,
    "service": "doloribus",
    "weight": 12613.63
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
true
```

### HTTP Request
`POST orders/{order}/packages`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `cod` | float |  required  | Whether it has cash on delivery for the customer to pay.
        `b2c` | integer |  optional  | 
        `routing_id` | integer |  optional  | 
        `phone` | string |  optional  | 
        `driver_note` | string |  optional  | 
        `recipient_note` | string |  optional  | 
        `source` | integer |  optional  | 
        `gar` | integer |  optional  | 
        `package_order` | integer |  optional  | 
        `commercial` | integer |  optional  | 
        `service` | string |  optional  | 
        `weight` | float |  optional  | The weight of the package.
    
<!-- END_bb21b6865e90c5d9acab1bbd53cb3bc3 -->

<!-- START_0b52eaa732f1dae5b24213f77dbe50fa -->
## Update the specified package in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/35022/packages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/35022/packages/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT orders/{order}/packages/{package}`

`PATCH orders/{order}/packages/{package}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `order` |  required  | order id

<!-- END_0b52eaa732f1dae5b24213f77dbe50fa -->

<!-- START_e44f959387010ea2a0027c8aa6b11c83 -->
## Remove the specified package from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/orders/1/packages/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/packages/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE orders/{order}/packages/{package}`


<!-- END_e44f959387010ea2a0027c8aa6b11c83 -->

#Product


<!-- START_fcdf2da1997bd4d8d126f782bc06524c -->
## Display a listing of products.

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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET products`


<!-- END_fcdf2da1997bd4d8d126f782bc06524c -->

<!-- START_e69e3804fa0af1eb523e480d661362b7 -->
## Store a newly created product.

> Example request:

```bash
curl -X POST \
    "http://localhost/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"category_id":18,"category_id2":7,"model":"necessitatibus","sku":"molestiae","location":"aperiam","quantity":1,"internal_quantity":6,"stock_status_id":6,"image":"nesciunt","manufacturer_id":8,"shipping":15,"price":25717032,"tax_class_id":13,"date_available":"quod","weight":641.6717,"weight_class_id":11,"length":4266.56071139,"width":547199.177921147,"height":158.77541,"measurement_class_id":19,"status":2,"viewed":2,"container_capacity":2,"req_container":13,"purchase_price":67.1010552,"viewed_month":14,"viewed_quartal":11,"viewed_year":7,"heureka":"veniam","heureka_cat":"animi","heureka_name":"assumenda","warranty":2,"sold_quartal":4,"conversion_quartal":16715.4386402,"free_shipping":8,"domains":"a","color1":"culpa","color2":"autem","color3":"ut","marketing_domain":"optio","raw_name":"voluptatem","zasilkovna_enabled":19,"condition":13,"erotic":11,"language":"ad","name":"rerum","meta_description":"nihil","meta_keywords":"incidunt","description":"quibusdam","intro":"non"}'

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
    "category_id": 18,
    "category_id2": 7,
    "model": "necessitatibus",
    "sku": "molestiae",
    "location": "aperiam",
    "quantity": 1,
    "internal_quantity": 6,
    "stock_status_id": 6,
    "image": "nesciunt",
    "manufacturer_id": 8,
    "shipping": 15,
    "price": 25717032,
    "tax_class_id": 13,
    "date_available": "quod",
    "weight": 641.6717,
    "weight_class_id": 11,
    "length": 4266.56071139,
    "width": 547199.177921147,
    "height": 158.77541,
    "measurement_class_id": 19,
    "status": 2,
    "viewed": 2,
    "container_capacity": 2,
    "req_container": 13,
    "purchase_price": 67.1010552,
    "viewed_month": 14,
    "viewed_quartal": 11,
    "viewed_year": 7,
    "heureka": "veniam",
    "heureka_cat": "animi",
    "heureka_name": "assumenda",
    "warranty": 2,
    "sold_quartal": 4,
    "conversion_quartal": 16715.4386402,
    "free_shipping": 8,
    "domains": "a",
    "color1": "culpa",
    "color2": "autem",
    "color3": "ut",
    "marketing_domain": "optio",
    "raw_name": "voluptatem",
    "zasilkovna_enabled": 19,
    "condition": 13,
    "erotic": 11,
    "language": "ad",
    "name": "rerum",
    "meta_description": "nihil",
    "meta_keywords": "incidunt",
    "description": "quibusdam",
    "intro": "non"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "product_id": 3332
}
```

### HTTP Request
`POST products`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `category_id` | integer |  required  | 
        `category_id2` | integer |  required  | 
        `model` | string |  required  | 
        `sku` | string |  required  | 
        `location` | string |  optional  | 
        `quantity` | integer |  optional  | 
        `internal_quantity` | integer |  optional  | 
        `stock_status_id` | integer |  required  | 
        `image` | string |  required  | 
        `manufacturer_id` | integer |  required  | 
        `shipping` | integer |  optional  | 
        `price` | float |  optional  | 
        `tax_class_id` | integer |  required  | 
        `date_available` | date |  required  | 
        `weight` | float |  optional  | 
        `weight_class_id` | integer |  optional  | 
        `length` | float |  optional  | 
        `width` | float |  optional  | 
        `height` | float |  optional  | 
        `measurement_class_id` | integer |  optional  | 
        `status` | integer |  optional  | 
        `viewed` | integer |  optional  | 
        `container_capacity` | integer |  required  | 
        `req_container` | integer |  optional  | 
        `purchase_price` | float |  optional  | 
        `viewed_month` | integer |  optional  | 
        `viewed_quartal` | integer |  optional  | 
        `viewed_year` | integer |  optional  | 
        `heureka` | string |  optional  | 
        `heureka_cat` | string |  optional  | 
        `heureka_name` | string |  optional  | 
        `warranty` | integer |  optional  | 
        `sold_quartal` | integer |  required  | 
        `conversion_quartal` | float |  required  | 
        `free_shipping` | integer |  optional  | 
        `domains` | string |  required  | 
        `color1` | string |  required  | 
        `color2` | string |  required  | 
        `color3` | string |  required  | 
        `marketing_domain` | string |  required  | 
        `raw_name` | string |  required  | 
        `zasilkovna_enabled` | integer |  optional  | 
        `condition` | integer |  optional  | 
        `erotic` | integer |  optional  | 
        `language` | string |  required  | 
        `name` | string |  required  | required
        `meta_description` | string |  required  | 
        `meta_keywords` | string |  required  | 
        `description` | string |  required  | 
        `intro` | string |  required  | 
    
<!-- END_e69e3804fa0af1eb523e480d661362b7 -->

<!-- START_6af8316bb6d4a4dac25704299765b459 -->
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
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET products/{product}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `product` |  required  | product id

<!-- END_6af8316bb6d4a4dac25704299765b459 -->

<!-- START_3d6f3cbb4f154b7da4faac30c3380d51 -->
## Update the specified product in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT products/{product}`

`PATCH products/{product}`


<!-- END_3d6f3cbb4f154b7da4faac30c3380d51 -->

<!-- START_9dc19a575e78a6169cad6bda8a2186de -->
## Remove the specified product from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE products/{product}`


<!-- END_9dc19a575e78a6169cad6bda8a2186de -->

#general


<!-- START_3cfd996e06d436b1692a0cd1ed486a97 -->
## Display a listing of order histories.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/1/history" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/history"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}/history`


<!-- END_3cfd996e06d436b1692a0cd1ed486a97 -->

<!-- START_ca68d4b0f503e2a8e485e5d0fdf52eda -->
## Store a newly created order history in storage

> Example request:

```bash
curl -X POST \
    "http://localhost/orders/1/history" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/history"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST orders/{order}/history`


<!-- END_ca68d4b0f503e2a8e485e5d0fdf52eda -->

<!-- START_ca4e158bb3b6916d61d62bbc65d316bf -->
## Display the specified order history.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/1/history/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/history/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET orders/{order}/history/{history}`


<!-- END_ca4e158bb3b6916d61d62bbc65d316bf -->

<!-- START_bba6f068e29fb7595d4329b94b65c915 -->
## Update the specified order history in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/1/history/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/history/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT orders/{order}/history/{history}`

`PATCH orders/{order}/history/{history}`


<!-- END_bba6f068e29fb7595d4329b94b65c915 -->

<!-- START_1b04b4700688f01d7db6cfdabca628dc -->
## Remove the specified order history from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/orders/1/history/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/history/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE orders/{order}/history/{history}`


<!-- END_1b04b4700688f01d7db6cfdabca628dc -->

<!-- START_323ae3009594898aaf58e7795ef8b835 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/1/products/1/moves" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/products/1/moves"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET orders/{order}/products/{product}/moves`


<!-- END_323ae3009594898aaf58e7795ef8b835 -->

<!-- START_cd4e23e37e39ccda25a02600c96491de -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/orders/1/products/1/moves" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/products/1/moves"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST orders/{order}/products/{product}/moves`


<!-- END_cd4e23e37e39ccda25a02600c96491de -->

<!-- START_dee56bb235ab92b5b587b8d4c96969a4 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/orders/1/products/1/moves/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/products/1/moves/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET orders/{order}/products/{product}/moves/{move}`


<!-- END_dee56bb235ab92b5b587b8d4c96969a4 -->

<!-- START_d464a6670366ceae791ace679f60a296 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/orders/1/products/1/moves/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/products/1/moves/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT orders/{order}/products/{product}/moves/{move}`

`PATCH orders/{order}/products/{product}/moves/{move}`


<!-- END_d464a6670366ceae791ace679f60a296 -->

<!-- START_8d2383a21e83aa6eb16c92eef2e2856c -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/orders/1/products/1/moves/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/orders/1/products/1/moves/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE orders/{order}/products/{product}/moves/{move}`


<!-- END_8d2383a21e83aa6eb16c92eef2e2856c -->


