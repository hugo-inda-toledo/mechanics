<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestServicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestServicesTable Test Case
 */
class RequestServicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestServicesTable
     */
    public $RequestServices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.request_services',
        'app.requests',
        'app.available_services',
        'app.items',
        'app.items_logs',
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
        'app.purcharse_orders',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
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
        $config = TableRegistry::exists('RequestServices') ? [] : ['className' => 'App\Model\Table\RequestServicesTable'];
        $this->RequestServices = TableRegistry::get('RequestServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestServices);

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
