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
use Illuminate\Http\Request;

class TestOrderController extends TestCase
{
    public $oid;
    protected function setUp() : void
    {
        parent::setUp();
        $this->oid = Order::max('order_id');
    }

    public function testStoreProduct1()
    {
        $pid = Product::max('product_id') + 1;
        $response = $this->postJson('/products',
            [
                "category_id" => 202,
                "category_id2" => 312,
                "model" => "88396",
                "sku" => "4015588883965",
                "location" => "",
                "quantity" => 1,
                "internal_quantity" => 4,
                "stock_status_id" => 14,
                "image" => "data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
                "manufacturer_id" => 6,
                "shipping" => 1,
                "price" => 100,
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
                "purchase_price" => 80,
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
        $response->assertStatus(200)
            ->assertJson(['product_id'=>$pid]);
        $this->assertDatabaseHas('oc_product',
            [
                "product_id" => $pid,
                "category_id" => 202,
                "category_id2" => 312,
                "model" => "88396",
                "sku" => "4015588883965",
                "location" => "",
                "quantity" => 1,
                "internal_quantity" => 4,
                "stock_status_id" => 14,
                "image" => "data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
                "manufacturer_id" => 6,
                "shipping" => 1,
                "price" => 100,
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
                "purchase_price" => 80,
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
                'quantity' => 6
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
            'total' => round($product->price * 6 * 1.21,4)
        ])->assertDatabaseHas('oc_order_product', [
            'order_id' => $oid,
            'product_id' => $pid,
            'name' => DB::table('oc_product_description')
                ->where('product_id',$pid)->value('name'),
            'model' => $product->model,
            'price' => $product->price,
            'purchase_price' => $product->purchase_price,
            'quantity' => 6,
            'total' => round($product->price * 6, 4),
            'warranty' => $product->warranty,
            'tax' => "21.0000"
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $oid,
            'product_id' => $pid,
            'quantity_int' => 4,
            'quantity_ext' => 2
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => -1,
            'internal_quantity' => 0
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '600 Kč',
            'value' => 600,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $oid,
            'title' => 'DPH 21%',
            'text' => '126 Kč',
            'value' => 126,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem s DPH',
            'text' => '726 Kč',
            'value' => 726,
            'sort_order' => 6
        ]);
    }

    public function testStoreOrder_product1()
    {
        $response = $this->postJson('/products',
            [
                "category_id" => 202,
                "category_id2" => 312,
                "model" => "88396",
                "sku" => "4015588883965",
                "location" => "",
                "quantity" => 1,
                "internal_quantity" => 8,
                "stock_status_id" => 14,
                "image" => "data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
                "manufacturer_id" => 6,
                "shipping" => 1,
                "price" => 100,
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
                "purchase_price" => 80,
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

        $product = Product::find($response->getData()->product_id);
        $oid = Order::max('order_id');
        $this->postJson('/orders/'.$this->oid.'/products',
            [
                'order_id' => $oid,
                'product_id' => $product->product_id,
                'quantity' => 6,
                'model' => $product->model,
                'price' => $product->price,
                'purchase_price' => $product->purchase_price,
                'warranty' => $product->warranty,
                'total' => $product->price * 6
            ]
        );

        $response->assertStatus(200);
        $this->assertDatabaseHas('oc_order_product', [
            'order_id' => $oid,
            'product_id' => $product->product_id,
            'name' => DB::table('oc_product_description')
                ->where('product_id',$product->product_id)->value('name'),
            'model' => $product->model,
            'price' => $product->price,
            'purchase_price' => $product->purchase_price,
            'quantity' => 6,
            'total' => round($product->price * 6, 4),
            'warranty' => $product->warranty,
            'tax' => "21.0000"
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $oid,
            'product_id' => $product->product_id,
            'quantity_int' => 6,
            'quantity_ext' => 0
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $product->product_id,
            'quantity' => 1,
            'internal_quantity' => 2
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '1200 Kč',
            'value' => 1200,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $oid,
            'title' => 'DPH 21%',
            'text' => '252 Kč',
            'value' => 252,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem s DPH',
            'text' => '1452 Kč',
            'value' => 1452,
            'sort_order' => 6
        ]);
    }

    public function testPutQuantity1()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id',$opid)->value('product_id');
        $response = $this->putJson('/orders/' . $this->oid . '/products/' . $opid,
            [
                'quantity' => 9
            ]);
        $response->assertStatus(200)
            ->assertJson(['quantity' => 'true']);
        $this->assertDatabaseHas('oc_order_product', [
            'order_product_id' => $opid,
            'quantity' => 9,
            'total' => round(100 * 9, 4),
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity_int' => 8,
            'quantity_ext' => 1
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => 0,
            'internal_quantity' => 0
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '1500 Kč',
            'value' => 1500,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $this->oid,
            'title' => 'DPH 21%',
            'text' => '315 Kč',
            'value' => 315,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem s DPH',
            'text' => '1815 Kč',
            'value' => 1815,
            'sort_order' => 6
        ]);
    }

    public function testPutQuantity2()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id',$opid)->value('product_id');
        $response = $this->putJson('/orders/' . $this->oid . '/products/' . $opid,
            [
                'quantity' => 3
            ]);
        $response->assertStatus(200)
            ->assertJson(['quantity' => 'true']);
        $this->assertDatabaseHas('oc_order_product', [
            'order_product_id' => $opid,
            'quantity' => 3,
            'total' => round(100 * 3, 4),
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity_int' => 3,
            'quantity_ext' => 0
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => 1,
            'internal_quantity' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '900 Kč',
            'value' => 900,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $this->oid,
            'title' => 'DPH 21%',
            'text' => '189 Kč',
            'value' => 189,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem s DPH',
            'text' => '1089 Kč',
            'value' => 1089,
            'sort_order' => 6
        ]);
    }

    public function testPutQuantity3()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id',$opid)->value('product_id');
        $response = $this->putJson('/orders/' . $this->oid . '/products/' . $opid,
            [
                'quantity' => 6
            ]);
        $response->assertStatus(200)
            ->assertJson(['quantity' => 'true']);

        $this->assertDatabaseHas('oc_order_product', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity' => 6,
            'total' => round(100 * 6, 4),
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity_int' => 6,
            'quantity_ext' => 0
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => 1,
            'internal_quantity' => 2
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '1200 Kč',
            'value' => 1200,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $this->oid,
            'title' => 'DPH 21%',
            'text' => '252 Kč',
            'value' => 252,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem s DPH',
            'text' => '1452 Kč',
            'value' => 1452,
            'sort_order' => 6
        ]);
    }

    public function testStoreOrder_product2()
    {
        $response = $this->postJson('/products',
            [
                "category_id" => 202,
                "category_id2" => 312,
                "model" => "88396",
                "sku" => "4015588883965",
                "location" => "",
                "quantity" => 8,
                "internal_quantity" => 0,
                "stock_status_id" => 14,
                "image" => "data/medisana/masaz/nohou/masazni-pristroj-na-nohy-a-zada-medisana-fm-883-88396.jpg",
                "manufacturer_id" => 6,
                "shipping" => 1,
                "price" => 100,
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
                "purchase_price" => 70,
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

        $product = Product::find($response->getData()->product_id);
        $oid = Order::max('order_id');
        $this->postJson('/orders/'.$this->oid.'/products',
            [
                'order_id' => $oid,
                'product_id' => $product->product_id,
                'quantity' => 6,
                'model' => $product->model,
                'price' => $product->price,
                'purchase_price' => $product->purchase_price,
                'warranty' => $product->warranty,
                'total' => $product->price * 6
            ]
        );

        $response->assertStatus(200);
        $this->assertDatabaseHas('oc_order_product', [
            'order_id' => $oid,
            'product_id' => $product->product_id,
            'name' => DB::table('oc_product_description')
                ->where('product_id',$product->product_id)->value('name'),
            'model' => $product->model,
            'price' => $product->price,
            'purchase_price' => $product->purchase_price,
            'quantity' => 6,
            'total' => round($product->price * 6, 4),
            'warranty' => $product->warranty,
            'tax' => "21.0000"
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $oid,
            'product_id' => $product->product_id,
            'quantity_int' => 0,
            'quantity_ext' => 6
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $product->product_id,
            'quantity' => 2,
            'internal_quantity' => 0
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '1800 Kč',
            'value' => 1800,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $oid,
            'title' => 'DPH 21%',
            'text' => '378 Kč',
            'value' => 378,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $oid,
            'title' => 'Cena celkem s DPH',
            'text' => '2178 Kč',
            'value' => 2178,
            'sort_order' => 6
        ]);
    }

    public function testPutQuantity4()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id',$opid)->value('product_id');
        $response = $this->putJson('/orders/' . $this->oid . '/products/' . $opid,
            [
                'quantity' => 9
            ]);
        $response->assertStatus(200)
            ->assertJson(['quantity' => 'true']);
        $this->assertDatabaseHas('oc_order_product',
            [
                'order_product_id' => $opid,
                'quantity' => 9,
                'total' => round(100 * 9, 4),
            ])->assertDatabaseHas('oc_order_product_move', [
                'order_id' => $this->oid,
                'product_id' => $pid,
                'quantity_int' => 0,
                'quantity_ext' => 9
            ])->assertDatabaseHas('oc_product', [
                'product_id' => $pid,
                'quantity' => -1,
                'internal_quantity' => 0
            ])->assertDatabaseHas('oc_order_total', [
                'order_id' => $this->oid,
                'title' => 'Cena celkem bez DPH',
                'text' => '2100 Kč',
                'value' => 2100,
                'sort_order' => 4
            ])->assertDatabaseHas('oc_order_total',[
                'order_id' => $this->oid,
                'title' => 'DPH 21%',
                'text' => '441 Kč',
                'value' => 441,
                'sort_order' => 5
            ])->assertDatabaseHas('oc_order_total', [
                'order_id' => $this->oid,
                'title' => 'Cena celkem s DPH',
                'text' => '2541 Kč',
                'value' => 2541,
                'sort_order' => 6
            ]);
    }

    public function testPutQuantity5()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id',$opid)->value('product_id');
        $response = $this->putJson('/orders/' . $this->oid . '/products/' . $opid,
            [
                'quantity' => 3
            ]);
        $response->assertStatus(200)
            ->assertJson(['quantity' => 'true']);
        $this->assertDatabaseHas('oc_order_product',
            [
                'order_product_id' => $opid,
                'quantity' => 3,
                'total' => round(100 * 3, 4),
            ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity_int' => 0,
            'quantity_ext' => 3
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => 5,
            'internal_quantity' => 0
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '1500 Kč',
            'value' => 1500,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $this->oid,
            'title' => 'DPH 21%',
            'text' => '315 Kč',
            'value' => 315,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem s DPH',
            'text' => '1815 Kč',
            'value' => 1815,
            'sort_order' => 6
        ]);
    }

    public function testPutQuantity6()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id',$opid)->value('product_id');
        $response = $this->putJson('/orders/' . $this->oid . '/products/' . $opid,
            [
                'quantity' => 6
            ]);
        $response->assertStatus(200)
            ->assertJson(['quantity' => 'true']);

        $this->assertDatabaseHas('oc_order_product', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity' => 6,
            'total' => round(100 * 6, 4),
        ])->assertDatabaseHas('oc_order_product_move', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity_int' => 0,
            'quantity_ext' => 6
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => 2,
            'internal_quantity' => 0
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '1800 Kč',
            'value' => 1800,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $this->oid,
            'title' => 'DPH 21%',
            'text' => '378 Kč',
            'value' => 378,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem s DPH',
            'text' => '2178 Kč',
            'value' => 2178,
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
            ->assertJson(
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
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'domain' => 'www.moje-medisana.cz'
            ]);
        $response->assertStatus(200)
            ->assertJson(['domain' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'domain' => 'www.moje-medisana.cz'
            ]);
    }

    public function testPutCustomer_id()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'customer_id' => 0
            ]);
        $response->assertStatus(200)
            ->assertJson(['customer_id' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'customer_id' => 0
            ]);
    }

    public function testPutCurrency()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'currency' => 'CZK'
            ]);
        $response->assertStatus(200)
            ->assertJson(['currency' => 'true']);
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
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'language' => 'Čeština'
            ]);
        $response->assertStatus(200)
            ->assertJson(['language' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'language_id' => 5
            ]);
    }

    public function testPutFirstname()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'firstname' => 'Jan'
            ]);
        $response->assertStatus(200)
            ->assertJson(['firstname' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'firstname' => 'Jan'
            ]);
    }

    public function testPutLastname()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'lastname' => 'Veverka'
            ]);
        $response->assertStatus(200)
            ->assertJson(['lastname' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'lastname' => 'Veverka'
            ]);
    }

    public function testPutCompany()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'company' => 'Škoda'
            ]);
        $response->assertStatus(200)
            ->assertJson(['company' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'company' => 'Škoda'
            ]);
    }

    public function testPutComment()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'comment' => 'Super.'
            ]);
        $response->assertStatus(200)
            ->assertJson(['comment' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'comment' => 'Super.'
            ]);
    }

    public function testPutOrder_status()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'order_status' => 'Odesláno dopravcem',
                'notify' => 1,
                'comment' => 'Objednávka zaplacena.'
            ]);
        $response->assertStatus(200)
            ->assertJson(['order_status' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'order_status_id' => 3
            ]);
        $this->assertDatabaseHas('oc_order_history',
            [
                'order_id' => $this->oid,
                'order_status_id' => 3,
                'notify' => 1,
                'comment' => 'Objednávka zaplacena.'
            ]);
    }

    public function testPutShipping_method()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'shipping_method' => 'Geis'
            ]);
        $response->assertStatus(200)
            ->assertJson(['shipping_method' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'shipping_method' => 'Geis'
            ]);
    }


    public function testPutPayment_status()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'payment_status' => 1
            ]);
        $response->assertStatus(200)
            ->assertJson(['payment_status' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'payment_status' => 1
            ]);
    }


    public function testPutReferrer()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'referrer' => 'Google'
            ]);
        $response->assertStatus(200)
            ->assertJson(['referrer' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'referrer' => 'Google'
            ]);
    }

    public function testPutAgree_gdpr()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'agree_gdpr' => 1
            ]);
        $response->assertStatus(200)
            ->assertJson(['agree_gdpr' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'agree_gdpr' => 1
            ]);
    }

    public function testPutPayment_method()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'payment_method' => 'Hotově'
            ]);
        $response->assertStatus(200)
            ->assertJson(['payment_method' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'payment_method' => 'Hotově'
            ]);
    }

    public function testPutEmail()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'email' => 'o@gmail.com'
            ]);
        $response->assertStatus(200)
            ->assertJson(['email' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'email' => 'o@gmail.com'
            ]);
    }

    public function testPutTelephone()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'telephone' => '+420555111444'
            ]);
        $response->assertStatus(200)
            ->assertJson(['telephone' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'telephone' => '+420555111444'
            ]);
    }

    public function testPutFax()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'fax' => '5adsfa'
            ]);
        $response->assertStatus(200)
            ->assertJson(['fax' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'fax' => '5adsfa'
            ]);
    }

    public function testPutRegNum()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'regNum' => '15611564'
            ]);
        $response->assertStatus(200)
            ->assertJson(['regNum' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'regNum' => '15611564'
            ]);
    }

    public function testPutTaxRegNum()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'taxRegNum' => '15611564'
            ]);
        $response->assertStatus(200)
            ->assertJson(['taxRegNum' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'taxRegNum' => '15611564'
            ]);
    }

    public function testPutCoupon_id()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'coupon_id' => '15664'
            ]);
        $response->assertStatus(200)
            ->assertJson(['coupon_id' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'coupon_id' => '15664'
            ]);
    }

    public function testPutShipping_gp()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'shipping_gp' => '5888'
            ]);
        $response->assertStatus(200)
            ->assertJson(['shipping_gp' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'shipping_gp' => '5888'
            ]);
    }

    public function testPutIp()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'ip' => '165.154.213.546'
            ]);
        $response->assertStatus(200)
            ->assertJson(['ip' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'ip' => '165.154.213.546'
            ]);
    }

    public function testPutReason()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'reason' => 'Nezaplatil.'
            ]);
        $response->assertStatus(200)
            ->assertJson(['reason' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'reason' => 'Nezaplatil.'
            ]);
    }

    public function testPutWrong_order_id()
    {
        $response = $this->putJson('/orders/' . $this->oid ,
            [
                'wrong_order_id' => '468'
            ]);
        $response->assertStatus(200)
            ->assertJson(['wrong_order_id' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'wrong_order_id' => '468'
            ]);
    }

    public function testPutCompetition()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'competition' => 0
            ]);
        $response->assertStatus(200)
            ->assertJson(['competition' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'competition' => 0
            ]);
    }

    public function testPutEuVAT()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'euVAT' => 0
            ]);
        $response->assertStatus(200)
            ->assertJson(['euVAT' => 'true']);
        $this->assertDatabaseHas('oc_order',
            [
                'order_id' => $this->oid,
                'euVAT' => 0
            ]);
    }

    public function testPutViewed()
    {
        $response = $this->putJson('/orders/' . $this->oid,
            [
                'viewed' => 1
            ]);
        $response->assertStatus(200)
            ->assertJson(['viewed' => 'true']);
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
        Order::where('order_id',$this->oid)->update(
            [
                'shipping_method' => 'Zásilkovna',
                'total' => 3000
            ]);
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
            'total' => "2<EUR>"]);
        $response = $this->get('/orders/'.$this->oid.'/price');
        $response->assertStatus(200);
        $this->assertEquals('2.99<EUR>',$response->baseResponse->content());
    }


    public function testShowOrder()
    {
        Order::where('order_id',$this->oid)->update(['total' => 3000]);
        $response = $this->get('/orders/'.$this->oid);
        $response->assertStatus(200)
            ->assertJson(
                [
                    'order_id' => $this->oid,
                    //'invoice_id' => ?,
                    'domain' => 'www.stylka.cz',
                    'firstname' => 'Jan',
                    'lastname' => 'Veverka',
                    'comment' => 'Objednávka zaplacena.',
                    'order_status' => 'Odesláno dopravcem',
                    'shipping_method' => 'Zásielkovňa',
                    'label' => 1,
                    'total' => 3000,
                    'payment_status' => 1,
                    'profit' => 420,
                    'slovakia' => 0,
                    'instock' => 0,
                    'referrer' => 'Google',
                    'agree_gdpr' => 1,
                    'payment_method' => 'Platba kartou',
                    'email' => 'o@gmail.com',
                    'telephone' => '+420555111444',
                ]
            );
    }

    public function testIndexOrders()
    {
        $count = Order::count();
        $response = $this->get('/orders');
        $response->assertStatus(200)
            ->assertJsonCount($count);
    }

    public function testDeleteOrder_product1()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id', $opid)->value('product_id');
        $response = $this->delete('/orders/'.$this->oid.'/products/'.$opid);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('oc_order_product', [
            'order_product_id' => $opid,
            'order_id' => $this->oid,
            'quantity' => 6,
            'tax' => "21.0000"
        ])->assertDatabaseMissing('oc_order_product_move', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity_int' => 0,
            'quantity_ext' => 6
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => 8,
            'internal_quantity' => 0
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '1200 Kč',
            'value' => 1200,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $this->oid,
            'title' => 'DPH 21%',
            'text' => '252 Kč',
            'value' => 252,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem s DPH',
            'text' => '1452 Kč',
            'value' => 1452,
            'sort_order' => 6
        ]);
        $this->delete('/products/'.$pid);
    }

    public function testDeleteOrder_product2()
    {
        $opid = Order_product::max('order_product_id');
        $pid = Order_product::where('order_product_id', $opid)->value('product_id');
        $response = $this->delete('/orders/'.$this->oid.'/products/'.$opid);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('oc_order_product', [
            'order_product_id' => $opid,
            'order_id' => $this->oid,
            'quantity' => 6,
            'tax' => "21.0000"
        ]);
        $this->assertDatabaseMissing('oc_order_product_move', [
            'order_id' => $this->oid,
            'product_id' => $pid,
            'quantity_int' => 6,
            'quantity_ext' => 0
        ])->assertDatabaseHas('oc_product', [
            'product_id' => $pid,
            'quantity' => 1,
            'internal_quantity' => 8
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem bez DPH',
            'text' => '600 Kč',
            'value' => 600,
            'sort_order' => 4
        ])->assertDatabaseHas('oc_order_total',[
            'order_id' => $this->oid,
            'title' => 'DPH 21%',
            'text' => '126 Kč',
            'value' => 126,
            'sort_order' => 5
        ])->assertDatabaseHas('oc_order_total', [
            'order_id' => $this->oid,
            'title' => 'Cena celkem s DPH',
            'text' => '726 Kč',
            'value' => 726,
            'sort_order' => 6
        ]);
        $this->delete('/products/'.$pid);

        $pid = Product::max('product_id');

        $this->postJson('/orders/'.$this->oid.'/products',
            [
                'product_id' => $pid,
            ]
        );

        $this->postJson('/orders/'.$this->oid.'/products',
            [
                'product_id' => $pid,
            ]
        );
    }

    public function testDeleteOrder()
    {
        $response = $this->delete('/orders/'.$this->oid);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('oc_order', ['order_id' => $this->oid])
            ->assertDatabaseMissing('oc_order_history', ['order_id' => $this->oid])
            ->assertDatabaseMissing('oc_order_product', ['order_id' => $this->oid])
            ->assertDatabaseMissing('oc_order_product_move', ['order_id' => $this->oid])
            ->assertDatabaseMissing('oc_order_total', ['order_id' => $this->oid]);
    }


}
