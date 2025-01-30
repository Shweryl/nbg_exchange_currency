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

    public function test_return_results_from_conversion(){
        $from = 'USD';
        $to = 'PHP';
        $rate = 58.29;
        $amount = 30;

        $estimate = [
            'from' => 'USD',
            'to' => 'PHP',
            'rate' => 58.29,
            'amount' => 30,
            'result' => 1748.7,
        ];

        $controller = new CurrencyController();
        $result = $controller->returnResults($from, $to, $rate, $amount);

        $this->assertEquals($estimate, $result);
    }

    public function test_not_valid_rest_currencies_for_available_routes(){
        $from = 'PHP';

        $controller = new CurrencyController();
        $rests = $controller->restCurrencies($from);

        $this->assertNotContains($from, $rests);
    }

    public function test_valid_rest_currencies_for_available_routes(){
        $from = 'USD';

        $expect = ['PHP', 'MYR','SGD', 'THB'];
        $controller = new CurrencyController();
        $rests = $controller->restCurrencies($from);

        $this->assertEqualsCanonicalizing($expect, $rests);
    }
}
