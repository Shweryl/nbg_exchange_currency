<?php

namespace Tests\Unit;

use App\Http\Controllers\CurrencyController;
use PHPUnit\Framework\TestCase;

class CurrencyConvertTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_accurate_currency_conversion(){

        $amount = 100;
        $rate = 3.45;

        $controller = new CurrencyController();
        $convert = $controller->calculateRate($amount, $rate);

        $this->assertEquals(345, $convert);
    }
}
