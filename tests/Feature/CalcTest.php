<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalcTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCalculator()
    {
        //Operation
        $this->artisan('calculate:compute 5+3')
        ->expectsOutput('Result: 8')
        ->assertExitCode(0);

        //Operation Any number
        $this->artisan('calculate:compute 13232223-222222')
        ->expectsOutput('Result: 13010001')
        ->assertExitCode(0);

         //Operation Decimal Point
         $this->artisan('calculate:compute 13232223.10+222222')
         ->expectsOutput('Result: 13454445.1')
         ->assertExitCode(0);

        //Operator
        $this->artisan('calculate:compute 10+10-10*10/10')
        ->expectsOutput('Result: 10')
        ->assertExitCode(0);

        //Square Root
        $this->artisan('calculate:compute 144sqrt')
        ->expectsOutput('Result: 12')
        ->assertExitCode(0);

        //Operator and Square Root
        $this->artisan('calculate:compute 10+10-10*10/10+134sqrt')
        ->expectsOutput('Result: 12')
        ->assertExitCode(0);

        //Invalid Operator input
        $this->artisan('calculate:compute 10s134sqrt')
        ->expectsOutput('Result: Invalid Operation')
        ->assertExitCode(1);

    }
}