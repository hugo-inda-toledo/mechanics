<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemsLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemsLogsTable Test Case
 */
class ItemsLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemsLogsTable
     */
    public $ItemsLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.items_logs',
        'app.request_services',
        'app.requests',
        'app.users',
        'app.user_types',
        'app.countries',
        'app.languages',
        'app.logs',
        'app.votings',
        'app.organizations',
        'app.organizations_users',
        'app.voting_tables',
        'app.users_voting_tables',
        'app.items',
        'app.purcharse_order_items',
        'app.available_services',
        'app.available_services_items',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.providers',
        'app.providers_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemsLogs') ? [] : ['className' => 'App\Model\Table\ItemsLogsTable'];
        $this->ItemsLogs = TableRegistry::get('ItemsLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemsLogs);

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
