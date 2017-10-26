<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestCancelationOptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestCancelationOptionsTable Test Case
 */
class RequestCancelationOptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestCancelationOptionsTable
     */
    public $RequestCancelationOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.request_cancelation_options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestCancelationOptions') ? [] : ['className' => 'App\Model\Table\RequestCancelationOptionsTable'];
        $this->RequestCancelationOptions = TableRegistry::get('RequestCancelationOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestCancelationOptions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
