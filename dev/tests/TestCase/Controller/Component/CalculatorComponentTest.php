<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CalculatorComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CalculatorComponent Test Case
 */
class CalculatorComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\CalculatorComponent
     */
    public $Calculator;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Calculator = new CalculatorComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Calculator);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
