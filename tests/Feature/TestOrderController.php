<?php

namespace Tests\Feature;

use App\Geis_numbering;
use App\Order_history;
use App\Postcz_numbering;
use App\Product;
use Tests\TestCase;
use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Order_product;

class TestOrderController extends TestCase
{
    public $oid;
    protected function setUp() : void
    {
        parent::setUp();
        $this->oid = Order::max('order_id');
    }

    public function testStoreProduct()
    {
        $pid = Product::max('product_id') + 1;
        $response = $this->postJson('/products',
            [
                "category_id" => 202,
                "category_id2" => 312,
                "model" => "88396",
                "sku" => "4015588883965",
                "location" => "",
                "quantity" => 0,
                "internal_quantity" => 1,
                "stock_status_id" => 14,
                "image" => "data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
                "manufacturer_id" => 6,
                "shipping" => 1,
                "price" => "1817.3554",
                "tax_class_id" => 20,
                "date_available" => "2019-05-29",
                "weight" => "0.00",
                "weight_class_id" => 1,
                "length" => "0.00",
                "width" => "0.00",
                "height" => "0.00",
                "measurement_class_id" => 1,
                "status" => 1,
                "viewed" => 0,
                "container_capacity" => 0,
                "req_container" => 0,
                "purchase_price" => "1099.0000",
                "viewed_month" => 129,
                "viewed_quartal" => 152,
                "viewed_year" => 152,
                "heureka" => "",
                "heureka_cat" => "",
                "heureka_name" => "",
                "warranty" => 24,
                "sold_quartal" => 1,
                "conversion_quartal" => "0.00658",
                "free_shipping" => 1,
                "domains" => "",
                "color1" => "ffffff",
                "color2" => "000000",
                "color3" => "",
                "marketing_domain" => "",
                "raw_name" => "",
                "zasilkovna_enabled" => 1,
                "condition" => 1,
                "erotic" => 0,
                'language' => 'Čeština',
                'name' => 'Holicí strojek Thovt',
                'meta_description' => 'lanžetový holící strojek Remington F3790 Dual Flex Foil Shaver',
                'meta_keywords' => 'planžetový, holící strojek, Remington, Remington F3790, pánské strojky, holení, planžety',
                'description' => '&lt;h2&gt;',
                'intro' => '&lt;p&gt;'
            ]
        );
        $response->assertStatus(200);
        $this->assertEquals($pid, $response->baseResponse->content());
        $this->assertDatabaseHas('oc_product',
            [
                "product_id" => $pid,
                "category_id" => 202,
                "category_id2" => 312,
                "model" => "88396",
                "sku" => "4015588883965",
                "location" => "",
                "quantity" => 0,
                "internal_quantity" => 1,
                "stock_status_id" => 14,
                "image" => "data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
                "manufacturer_id" => 6,
                "shipping" => 1,
                "price" => 1817.3554,
                "tax_class_id" => 20,
                "date_available" => "2019-05-29",
                "weight" => "0.00",
                "weight_class_id" => 1,
                "length" => "0.00",
                "width" => "0.00",
                "height" => "0.00",
                "measurement_class_id" => 1,
                "status" => 1,
                "viewed" => 0,
                "container_capacity" => 0,
                "req_container" => 0,
                "purchase_price" => "1099.0000",
                "viewed_month" => 129,
                "viewed_quartal" => 152,
                "viewed_year" => 152,
                "heureka" => "",
                "heureka_cat" => "",
                "heureka_name" => "",
                "warranty" => 24,
                "sold_quartal" => 1,
                "conversion_quartal" => "0.00658",
                "free_shipping" => 1,
                "domains" => "",
                "color1" => "ffffff",
                "color2" => "000000",
                "color3" => "",
                "marketing_domain" => "",
                "raw_name" => "",
                "zasilkovna_enabled" => 1,
                "condition" => 1,
                "erotic" => 0
            ]
        )->assertDatabaseHas('oc_product_description',
            [
                'product_id' => $pid,
                'language_id' => 5,
                'name' => 'Holicí strojek Thovt',
                'meta_description' => 'lanžetový holící strojek Remington F3790 Dual Flex Foil Shaver',
                'meta_keywords' => 'planžetový, holící strojek, Remington, Remington F3790, pánské strojky, holení, planžety',
                'description' => '&lt;h2&gt;',
                'intro' => '&lt;p&gt;'
            ]);
    }

    public function testStoreOrder()
    {
        $pid = Product::max('product_id');
        $oid = Order::max('order_id') + 1;
        $opid = Order_product::max('order_product_id') + 1;
        $response = $this->postJson('/orders',
            [
                'domain' => 'www.milka.cz',
                'customer_id' => 0,
                'language' => 'Čeština',
                'ip' => '90.179.92.144',
                'referrer' => 'heureka.cz',
                'product_id' => $pid,
                'quantity' => 2,
                'quantity_int' => 1,
                'quantity_ext' => 1
            ]
        );
        $product = Product::where('product_id',$pid)->first();

        $response->assertStatus(200)
            ->assertJson([
                'order_id' => $oid,
                'order_product_id' => $opid
            ]);
        $this->assertDatabaseHas('oc_order', [
            'order_id' => $oid,
            'domain' => 'www.milka.cz',
            'customer_id' => 0,
            'language_id' => 5,
            'currency' => 'CZK',
            'currency_id' => 4,
            'ip' => '90.179.92.144',
            'referrer' => 'heureka.cz',
            'total' => round($product->price * 2 * 1.21,4)
        ])->assertDatabaseHas('oc_order_product', [
            'order_id' => $oid,
            'product_id' => $pid,
            'name' => DB::table('oc_product_description')
                ->where('product_id',$pid)->value('name'),
            'model' => $product->model,
            'price' => $product->price,
            'purchase_price' => $product->purchase_price,
            'quantity' => 2,
            'total' => $product->price * 2,
            'warranty' => $product->warranty,
            'tax' => 21
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $oid,
            'product_id' => $pid,
            'quantity_int' => 1,
            'quantity_ext' => 1
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '3634.7108 Kč',
            'value' => 3634.7108,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $oid,
            'title' => 'DPH 21%',
            'text' => '763.289268 Kč',
            'value' => 763.2893,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem s DPH',
            'text' => '4398.000068 Kč',
            'value' => 4398.0001,
            'sort_order' => 6
        ]);
    }

    public function testStoreOrder_history()
    {
        $id = Order_history::max('order_history_id') + 1;
        $response = $this->postJson('/orders/'.$this->oid.'/history',
            [
                'order_id' => $this->oid,
                'order_status_id' => 1,
                'notify' => 1,
                'comment' => ''
            ]
        );
        $response->assertStatus(200);
        $this->assertEquals($id, $response->baseResponse->content());
    }


    public function testPutAddresses()
    {
        $response = $this->putJson('/orders/'.$this->oid,
            [
                'shipping_firstname' => 'Pavel',
                'shipping_lastname' => 'Novák',
                'shipping_company' => 'Hyundai',
                'shipping_address_1' => 'Pálená 703',
                'shipping_address_2' => '',
                'shipping_city' => 'Jeseník',
                'shipping_postcode' => '75501',
                'shipping_zone' => '',
                'shipping_zone_id' => '',
                'shipping_country' => 'Česká republika',
                'shipping_country_id' => 56,
                'shipping_address_format' => '',
                'payment_firstname' => 'Pavel',
                'payment_lastname' => 'Novák',
                'payment_company' => 'Hyundai',
                'payment_address_1' => 'Pálená 703',
                'payment_address_2' => '',
                'payment_city' => 'Jeseník',
                'payment_postcode' => '75501',
                'payment_zone' => '',
                'payment_zone_id' => '',
                'payment_country' => 'Česká republika',
                'payment_country_id' => 56,
                'payment_address_format' => ''
            ]);
        $response
            ->assertStatus(200)
            ->assertJsonEquals(
                [
                    'shipping_firstname' => 'true',
                    'shipping_lastname' => 'true',
                    'shipping_company' => 'true',
                    'shipping_address_1' => 'true',
                    'shipping_address_2' => 'true',
                    'shipping_city' => 'true',
                    'shipping_postcode' => 'true',
                    'shipping_zone' => 'true',
                    'shipping_zone_id' => 'true',
                    'shipping_country' => 'true',
                    'shipping_country_id' => 'true',
                    'shipping_address_format' => 'true',
                    'payment_firstname' => 'true',
                    'payment_lastname' => 'true',
                    'payment_company' => 'true',
                    'payment_address_1' => 'true',
                    'payment_address_2' => 'true',
                    'payment_city' => 'true',
                    'payment_postcode' => 'true',
                    'payment_zone' => 'true',
                    'payment_zone_id' => 'true',
                    'payment_country' => 'true',
                    'payment_country_id' => 'true',
                    'payment_address_format' => 'true'
                ]
            );
        $this->assertDatabaseHas('oc_order',[
            'order_id' => $this->oid,
            'shipping_firstname' => 'Pavel',
            'shipping_lastname' => 'Novák',
            'shipping_company' => 'Hyundai',
            'shipping_address_1' => 'Pálená 703',
            'shipping_address_2' => '',
            'shipping_city' => 'Jeseník',
            'shipping_postcode' => '75501',
            'shipping_zone' => '',
            'shipping_zone_id' => '',
            'shipping_country' => 'Česká republika',
            'shipping_country_id' => 56,
            'shipping_address_format' => '',
            'payment_firstname' => 'Pavel',
            'payment_lastname' => 'Novák',
            'payment_company' => 'Hyundai',
            'payment_address_1' => 'Pálená 703',
            'payment_address_2' => '',
            'payment_city' => 'Jeseník',
            'payment_postcode' => '75501',
            'payment_zone' => '',
            'payment_zone_id' => '',
            'payment_country' => 'Česká republika',
            'payment_country_id' => 56,
            'payment_address_format' => ''
        ]);
    }

    public function testGetAddresses()
    {
        $response = $this->get('/orders/'.$this->oid.'/addresses');
        $response->assertStatus(200)
            ->assertJson(
            [
                'shipping_firstname' => 'Pavel',
                'shipping_lastname' => 'Novák',
                'shipping_company' => 'Hyundai',
                'shipping_address_1' => 'Pálená 703',
                'shipping_address_2' => '',
                'shipping_city' => 'Jeseník',
                'shipping_postcode' => '75501',
                'shipping_zone' => '',
                'shipping_zone_id' => '',
                'shipping_country' => 'Česká republika',
                'shipping_country_id' => 56,
                'shipping_address_format' => '',
                'payment_firstname' => 'Pavel',
                'payment_lastname' => 'Novák',
                'payment_company' => 'Hyundai',
                'payment_address_1' => 'Pálená 703',
                'payment_address_2' => '',
                'payment_city' => 'Jeseník',
                'payment_postcode' => '75501',
                'payment_zone' => '',
                'payment_zone_id' => '',
                'payment_country' => 'Česká republika',
                'payment_country_id' => 56,
                'payment_address_format' => ''
            ]
        );
    }

    public function testPutInvoice()
    {
        $response = $this->put('/orders/' . $this->oid . '/invoice');
        $response->assertStatus(200);
        $this->assertEquals('true', $response->baseResponse->content());
    }

    public function testPutDomain()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/domain',
            [
                'domain' => 'www.moje-medisana.cz'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['domain' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'domain' => 'www.moje-medisana.cz'
            ]);
    }

    public function testPutCurrency()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/currency',
            [
                'currency' => 'CZK'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['currency' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'currency' => 'CZK',
                'currency_id' => 4,
                'value' => 1
            ]);
    }

    public function testPutLanguage()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/language',
            [
                'language' => 'Čeština'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['language' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'language_id' => 5
            ]);
    }

    public function testPutFirstname()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/firstname',
            [
                'firstname' => 'Jan'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['firstname' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'firstname' => 'Jan'
            ]);
    }

    public function testPutLastname()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/lastname',
            [
                'lastname' => 'Veverka'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['lastname' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'lastname' => 'Veverka'
            ]);
    }

    public function testPutCompany()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/company',
            [
                'company' => 'Škoda'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['company' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'company' => 'Škoda'
            ]);
    }

    public function testPutComment()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/comment',
            [
                'comment' => 'Super.'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['comment' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'comment' => 'Super.'
            ]);
    }

    public function testPutOrder_status()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/order_status',
            [
                'order_status' => 1,
                'notify' => 1,
                'commnent' => 'Objednávka zaplacena.'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['order_status' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'order_status_id' => 1
            ]);
    }

    public function testPutShipping_method()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/shipping_method',
            [
                'shipping_method' => 'Geis'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['shipping_method' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'shipping_method' => 'Geis'
            ]);
    }


    public function testPutPayment_status()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/payment_status',
            [
                'payment_status' => 1
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['payment_status' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'payment_status' => 1
            ]);
    }


    public function testPutReferrer()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/referrer',
            [
                'referrer' => 'Google'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['referrer' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'referrer' => 'Google'
            ]);
    }

    public function testPutAgree_gdpr()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/agree_gdpr',
            [
                'agree_gdpr' => 1
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['agree_gdpr' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'agree_gdpr' => 1
            ]);
    }

    public function testPutPayment_method()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/payment_method',
            [
                'payment_method' => 'Hotově'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['payment_method' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'payment_method' => 'Hotově'
            ]);
    }

    public function testPutEmail()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/email',
            [
                'email' => 'o@gmail.com'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['email' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'email' => 'o@gmail.com'
            ]);
    }

    public function testPutTelephone()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/telephone',
            [
                'telephone' => '+420555111444'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['telephone' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'telephone' => '+420555111444'
            ]);
    }

    public function testPutFax()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/fax',
            [
                'fax' => '5adsfa'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['fax' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'fax' => '5adsfa'
            ]);
    }

    public function testPutRegNum()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/regNum',
            [
                'regNum' => '15611564'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['regNum' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'regNum' => '15611564'
            ]);
    }

    public function testPutTaxRegNum()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/taxRegNum',
            [
                'taxRegNum' => '15611564'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['taxRegNum' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'taxRegNum' => '15611564'
            ]);
    }

    public function testPutCoupon_id()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/coupon_id',
            [
                'coupon_id' => '15664'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['coupon_id' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'coupon_id' => '15664'
            ]);
    }

    public function testPutShipping_gp()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/shipping_gp',
            [
                'shipping_gp' => '5888'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['shipping_gp' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'shipping_gp' => '5888'
            ]);
    }

    public function testPutIp()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/ip',
            [
                'ip' => '165.154.213.546'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['ip' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'ip' => '165.154.213.546'
            ]);
    }

    public function testPutReason()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/reason',
            [
                'reason' => 'Nezaplatil.'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['reason' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'reason' => 'Nezaplatil.'
            ]);
    }

    public function testPutWrong_order_id()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/wrong_order_id',
            [
                'wrong_order_id' => '468'
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['wrong_order_id' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'wrong_order_id' => '468'
            ]);
    }

    public function testPutCompetition()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/competition',
            [
                'competition' => 0
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['competition' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'competition' => 0
            ]);
    }

    public function testPutEuVAT()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/euVAT',
            [
                'euVAT' => 0
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['euVAT' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'euVAT' => 0
            ]);
    }

    public function testPutViewed()
    {
        $response = $this->putJson('/orders/' . $this->oid . '/viewed',
            [
                'viewed' => 1
            ]);
        $response->assertStatus(200)
            ->assertJsonEquals(['viewed' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'viewed' => 1
            ]);
    }

    public function testStoreGeisPackage()
    {
        $delivery_id =  Geis_numbering::select('min')->where('is_free', 1)->first();
        $response = $this->postJson('/orders/'.$this->oid.'/packages',
            [
                'cod' => 804.00,
                'b2c' => 1,
                'routing_id' => 133,
                'phone' => '+420732172260',
                'driver_note' => '',
                'recipient_note' => '',
                'source' => 0,
                'gar' => 0,
                'package_order' => 1
            ]);
        $response
            ->assertStatus(200);
        $this->assertEquals('true', $response->baseResponse->content());
        $this->assertDatabaseHas('geis_delivery',[
            'delivery_id' => $delivery_id->min,
            'order_id' => $this->oid,
            'cod' => 804.00,
            'b2c' => 1,
            'routing_id' => 133,
            'phone' => '+420732172260',
            'driver_note' => '',
            'recipient_note' => '',
            'source' => 0,
            'gar' => 0,
        ]);
        $this->assertDatabaseHas('geis_package',[
            'package_id' => $delivery_id->min,
            'delivery_id' => $delivery_id->min,
            'order_id' => $this->oid,
            'package_order' => 1
        ]);
        $this->assertDatabaseHas('geis_numbering',[
            'max' => $delivery_id->min,
            'is_free' => 0,
        ]);
        $this->assertDatabaseHas('geis_numbering',[
            'min' => $delivery_id->min + 1,
            'is_free' => 1,
        ]);
    }

    public function testStorePostczPackage()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Česká pošta']);
        $delivery_id = Postcz_numbering::select('min')->where('is_free', 1)
            ->where('source',3)->first();
        $response = $this->postJson('/orders/'.$this->oid.'/packages',
            [
                'cod' => 804.00,
                'commercial' => 0,
                'service' => 'DR',
                'phone' => '+420732353237',
                'source' => 3,
                'package_order' => 1,
                'weight' => 0.618
            ]);
        $response
            ->assertStatus(200);
        $this->assertEquals('true', $response->baseResponse->content());
        $this->assertDatabaseHas('postcz_delivery',[
            'delivery_id' => $delivery_id->min,
            'order_id' => $this->oid,
            'cod' => 804.00,
            'commercial' => 0,
            'service' => 'DR',
            'packages' => 1,
            'phone' => '+420732353237',
            'source' => 3,
            'last_status' => "Zatím nezjištěn"
        ]);
        $this->assertDatabaseHas('postcz_package',[
            'package_id' => $delivery_id->min,
            'delivery_id' => $delivery_id->min,
            'order_id' => $this->oid,
            'package_order' => 1,
            'weight' => 0.618
        ]);
        $this->assertDatabaseHas('postcz_numbering',[
            'max' => $delivery_id->min,
            'is_free' => 0,
            'source' => 3
        ]);
        $this->assertDatabaseHas('postcz_numbering',[
            'min' => $delivery_id->min + 1,
            'is_free' => 1,
            'source' => 3
        ]);
    }

    public function testStoreZasilkovnaPackage()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Zásilkovna']);
        $response = $this->postJson('/orders/'.$this->oid.'/packages',
            [
                'cod' => 0,
                'weight' => 0.618
            ]);
        $response->assertStatus(200);
        $this->assertEquals('true', $response->baseResponse->content());
        $this->assertDatabaseHas('zasilkovna_package',[
            'order_id' => $this->oid,
            'active' => 1
        ]);
    }

    public function testGetPrice_1()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Zásilkovna']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(0,$response->baseResponse->content());
    }

    public function testGetPrice_2()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Zásielkovňa']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('4.99<EUR>',$response->baseResponse->content());
    }

    public function testGetPrice_3()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'GLS']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('7.99<EUR>',$response->baseResponse->content());
    }

    public function testGetPrice_4()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Slovenská pošta']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('7.99<EUR>',$response->baseResponse->content());
    }

    public function testGetPrice_5()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'DPD']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(149,$response->baseResponse->content());
    }

    public function testGetPrice_6()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Geis']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(0,$response->baseResponse->content());
    }

    public function testGetPrice_7()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Česká pošta (Balík Do ruky)']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(119,$response->baseResponse->content());
    }

    public function testGetPrice_8()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Česká pošta (Balík Na poštu)']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(30,$response->baseResponse->content());
    }

    public function testGetPrice_9()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Česká pošta (Balík Do balíkovny)']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(30,$response->baseResponse->content());
    }

    public function testGetPrice_10()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Geis Slovensko']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('9.99<EUR>',$response->baseResponse->content());
    }

    public function testGetPrice_11()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Zásilkovna',
            'payment_method'=>'Platba kartou','domain'=>'www.stylka.cz']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(0,$response->baseResponse->content());
    }

    public function testGetPrice_12()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Zásielkovňa']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(0,$response->baseResponse->content());
    }

    public function testGetPrice_13()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'GLS']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('4.99<EUR>',$response->baseResponse->content());
    }

    public function testGetPrice_14()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Slovenská pošta']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('4.99<EUR>',$response->baseResponse->content());
    }

    public function testGetPrice_15()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'DPD']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(99,$response->baseResponse->content());
    }

    public function testGetPrice_16()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Geis']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(0,$response->baseResponse->content());
    }

    public function testGetPrice_17()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Česká pošta (Balík Do ruky)']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(89,$response->baseResponse->content());
    }

    public function testGetPrice_18()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Česká pošta (Balík Na poštu)']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(0,$response->baseResponse->content());
    }

    public function testGetPrice_19()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Česká pošta (Balík Do balíkovny)']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals(0,$response->baseResponse->content());
    }

    public function testGetPrice_20()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Geis Slovensko']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('6.99<EUR>',$response->baseResponse->content());
    }

    public function testGetPrice_21()
    {
        Order::where('order_id',$this->oid)->update(['shipping_method' => 'Zásielkovňa',
            'total' => '2<EUR>']);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('2.99<EUR>',$response->baseResponse->content());
    }


    public function testShowOrder()
    {
        $response = $this->get('/orders/'.$this->oid);
        $response->assertStatus(200)
            ->assertJson(
                [
                    'order_id' => $this->oid,
                    //'invoice_id' => ?,
                    'domain' => 'www.moje-medisana.cz',
                    'firstname' => 'Jan',
                    'lastname' => 'Veverka',
                    'comment' => 'Super.',
                    'order_status' => 'Nevyř&iacute;zeno',
                    'shipping_method' => 'Zásilkovna',
                    'label' => 1,
                    'total' => "100.0000",
                    'payment_status' => 1,
                    'profit' => "1436.7108",
                    'slovakia' => 0,
                    '+' => 0,
                    'referrer' => 'Google',
                    'agree_gdpr' => 1,
                    'payment_method' => 'Hotově',
                    'email' => 'o@gmail.com',
                    'telephone' => '+420555111444',
                ]
            );
    }

    public function testIndexOrders()//chunking by byl lepší
    {
        $count = Order::count();
        $response = $this->get('/orders');
        $response->assertStatus(200)
            ->assertJsonCount($count);
    }

    /*public function testDeleteOrder() //ještě smazat navazující tabulky
    {
        $response = $this->delete('/orders/'.$this->oid);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('oc_order',
            ['order_id' => $this->oid]);
    }*/


}
