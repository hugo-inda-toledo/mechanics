<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProvidersItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProvidersItemsTable Test Case
 */
class ProvidersItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProvidersItemsTable
     */
    public $ProvidersItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.providers_items',
        'app.providers',
        'app.items',
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
        'app.purcharse_order_items',
        'app.available_services',
        'app.available_services_items',
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
        $config = TableRegistry::exists('ProvidersItems') ? [] : ['className' => 'App\Model\Table\ProvidersItemsTable'];
        $this->ProvidersItems = TableRegistry::get('ProvidersItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProvidersItems);

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
