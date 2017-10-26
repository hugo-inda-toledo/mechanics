<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestsTypesAvailableServicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestsTypesAvailableServicesTable Test Case
 */
class RequestsTypesAvailableServicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestsTypesAvailableServicesTable
     */
    public $RequestsTypesAvailableServices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requests_types_available_services',
        'app.requests_types',
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
        'app.cars',
        'app.communes',
        'app.users_communes',
        'app.answered_surveys',
        'app.surveys',
        'app.health_reports',
        'app.items_logs',
        'app.request_services',
        'app.available_services',
        'app.items',
        'app.purcharse_order_items',
        'app.purcharse_orders',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
        'app.payments',
        'app.payment_methods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestsTypesAvailableServices') ? [] : ['className' => 'App\Model\Table\RequestsTypesAvailableServicesTable'];
        $this->RequestsTypesAvailableServices = TableRegistry::get('RequestsTypesAvailableServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestsTypesAvailableServices);

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
