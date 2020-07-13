<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\API\OrderController;

class TestDomain_setupValue extends TestCase
{
    public $oc;
    protected function setUp(): void
    {
        parent::setUp();
        $this->oc = new OrderController;
    }

    public function testGetAddressesOfOrder()
    {
        $response = $this->get('/orders/35000/addresses');
        $response
            ->assertStatus(200)
            ->assertJson([
                'shipping_address_1' => 'Jiráskova 274/5',
                'shipping_address_2' => '',
                'shipping_city' => 'Vyškov',
                'shipping_postcode' => '682 01',
                'shipping_zone' => '',
                'shipping_country' => 'Česká republika',
                'payment_address_1' => 'Jiráskova 274/5',
                'payment_address_2' => '',
                'payment_city' => 'Vyškov',
                'payment_postcode' => '682 01',
                'payment_zone' => '',
                'payment_country' => 'Česká republika',
                'shipping_address_2' => ''
            ]);
        $this->assertEquals(1,1);
    }

    /** Test */
    /*public function get_history_of_order()
    {
        $response = $this->get('/orders/35000/addresses');
        $response
            ->assertStatus(200)
            ->assertJson([
                'shipping_address_1' => 'Jiráskova 274/5',
                'shipping_address_2' => '',
                'shipping_city' => 'Vyškov',
                'shipping_postcode' => '682 01',
                'shipping_zone' => '',
                'shipping_country' => 'Česká republika',
                'payment_address_1' => 'Jiráskova 274/5',
                'payment_address_2' => '',
                'payment_city' => 'Vyškov',
                'payment_postcode' => '682 01',
                'payment_zone' => '',
                'payment_country' => 'Česká republika',
                'shipping_address_2' => ''
            ]);
    }*/

    public function testDomain_setupValue_1()
    {
        $this->assertEquals(($this->oc)->domain_setupValue("f:0,600:49,:0", 1, 30), 0);
        $this->assertEquals(($this->oc)->domain_setupValue("f:0,600:49,:0", 1, 700), 0);
        $this->assertEquals(($this->oc)->domain_setupValue("f:0,600:49,:0", 0, 500), 49);
        $this->assertEquals(($this->oc)->domain_setupValue("f:0,600:49,:0", 0, 700), 0);
    }

    public function testDomain_setupValue_2()
    {
        $this->assertEquals($this->oc->domain_setupValue(":30,:0", 1, 30), 30);
        $this->assertEquals($this->oc->domain_setupValue(":30,:0", 1, 700), 30);
        $this->assertEquals($this->oc->domain_setupValue(":30,:0", 0, 30), 30);
        $this->assertEquals($this->oc->domain_setupValue(":30,:0", 0, 700), 30);
    }

    public function testDomain_setupValue_3()
    {
        $oc = new OrderController;
        $this->assertEquals($this->oc->domain_setupValue("4000:6.99<EUR>,:0", 1, 30), "6.99<EUR>");
        $this->assertEquals($this->oc->domain_setupValue("4000:6.99<EUR>,:0", 1, 4700), 0);
        $this->assertEquals($this->oc->domain_setupValue("4000:6.99<EUR>,:0", 0, 30), "6.99<EUR>");
        $this->assertEquals($this->oc->domain_setupValue("4000:6.99<EUR>,:0", 0, 4700), 0);
    }

    public function testDomain_setupValue_4()
    {
        $oc = new OrderController;
        $this->assertEquals($this->oc->domain_setupValue("2500:40,:0", 1, 30), 40);
        $this->assertEquals($this->oc->domain_setupValue("2500:40,:0", 1, 4700), 0);
        $this->assertEquals($this->oc->domain_setupValue("2500:40,:0", 0, 30), 40);
        $this->assertEquals($this->oc->domain_setupValue("2500:40,:0", 0, 2700), 0);
    }

    public function testDomain_setupValue_5()
    {
        $oc = new OrderController;
        $this->assertEquals($this->oc->domain_setupValue(":3.00<EUR>", 1, 30), "3.00<EUR>");
        $this->assertEquals($this->oc->domain_setupValue(":3.00<EUR>", 1, 4700), "3.00<EUR>");
        $this->assertEquals($this->oc->domain_setupValue(":3.00<EUR>", 0, 30), "3.00<EUR>");
        $this->assertEquals($this->oc->domain_setupValue(":3.00<EUR>", 0, 700), "3.00<EUR>");
    }

    public function testDomain_setupValue_6()
    {
        $oc = new OrderController;
        $this->assertEquals($this->oc->domain_setupValue("35<EUR>:2.99<EUR>,:0", 1, 30), "2.99<EUR>");
        $this->assertEquals($this->oc->domain_setupValue("35<EUR>:2.99<EUR>,:0", 1, 40700), 0);
        $this->assertEquals($this->oc->domain_setupValue("35<EUR>:2.99<EUR>,:0", 0, 30), "2.99<EUR>");
        $this->assertEquals($this->oc->domain_setupValue("35<EUR>:2.99<EUR>,:0", 0, 70000), 0);
    }
}
