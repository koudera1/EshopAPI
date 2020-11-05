<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\API\OrderController;

class TestDomain_setupValue extends TestCase
{

    public function testDomain_setupValue_1()
    {
        $this->assertEquals(OrderController::domain_setupValue("f:0,600:49,:0", 1, 30), 0);
        $this->assertEquals(OrderController::domain_setupValue("f:0,600:49,:0", 1, 700), 0);
        $this->assertEquals(OrderController::domain_setupValue("f:0,600:49,:0", 0, 500), 49);
        $this->assertEquals(OrderController::domain_setupValue("f:0,600:49,:0", 0, 700), 0);
    }

    public function testDomain_setupValue_2()
    {
        $this->assertEquals(OrderController::domain_setupValue(":30,:0", 1, 30), 30);
        $this->assertEquals(OrderController::domain_setupValue(":30,:0", 1, 700), 30);
        $this->assertEquals(OrderController::domain_setupValue(":30,:0", 0, 30), 30);
        $this->assertEquals(OrderController::domain_setupValue(":30,:0", 0, 700), 30);
    }

    public function testDomain_setupValue_3()
    {
        $this->assertEquals(OrderController::domain_setupValue("4000:6.99<EUR>,:0", 1, 30), "6.99<EUR>");
        $this->assertEquals(OrderController::domain_setupValue("4000:6.99<EUR>,:0", 1, 4700), 0);
        $this->assertEquals(OrderController::domain_setupValue("4000:6.99<EUR>,:0", 0, 30), "6.99<EUR>");
        $this->assertEquals(OrderController::domain_setupValue("4000:6.99<EUR>,:0", 0, 4700), 0);
    }

    public function testDomain_setupValue_4()
    {
        $this->assertEquals(OrderController::domain_setupValue("2500:40,:0", 1, 30), 40);
        $this->assertEquals(OrderController::domain_setupValue("2500:40,:0", 1, 4700), 0);
        $this->assertEquals(OrderController::domain_setupValue("2500:40,:0", 0, 30), 40);
        $this->assertEquals(OrderController::domain_setupValue("2500:40,:0", 0, 2700), 0);
    }

    public function testDomain_setupValue_5()
    {
        $this->assertEquals(OrderController::domain_setupValue(":3.00<EUR>", 1, 30), "3.00<EUR>");
        $this->assertEquals(OrderController::domain_setupValue(":3.00<EUR>", 1, 4700), "3.00<EUR>");
        $this->assertEquals(OrderController::domain_setupValue(":3.00<EUR>", 0, 30), "3.00<EUR>");
        $this->assertEquals(OrderController::domain_setupValue(":3.00<EUR>", 0, 700), "3.00<EUR>");
    }

    public function testDomain_setupValue_6()
    {
        $oc = new OrderController;
        $this->assertEquals(OrderController::domain_setupValue("35<EUR>:2.99<EUR>,:0", 1, 30), "2.99<EUR>");
        $this->assertEquals(OrderController::domain_setupValue("35<EUR>:2.99<EUR>,:0", 1, 40700), 0);
        $this->assertEquals(OrderController::domain_setupValue("35<EUR>:2.99<EUR>,:0", 0, 30), "2.99<EUR>");
        $this->assertEquals(OrderController::domain_setupValue("35<EUR>:2.99<EUR>,:0", 0, 70000), 0);
    }
}
