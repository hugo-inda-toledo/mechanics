<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AvailableServicesItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AvailableServicesItemsTable Test Case
 */
class AvailableServicesItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AvailableServicesItemsTable
     */
    public $AvailableServicesItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.available_services_items',
        'app.available_services',
        'app.request_services',
        'app.items',
        'app.requests_types',
        'app.requests_types_available_services'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AvailableServicesItems') ? [] : ['className' => 'App\Model\Table\AvailableServicesItemsTable'];
        $this->AvailableServicesItems = TableRegistry::get('AvailableServicesItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AvailableServicesItems);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
