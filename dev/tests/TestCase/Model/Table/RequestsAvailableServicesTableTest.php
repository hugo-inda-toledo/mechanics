<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestsAvailableServicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestsAvailableServicesTable Test Case
 */
class RequestsAvailableServicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestsAvailableServicesTable
     */
    public $RequestsAvailableServices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requests_available_services',
        'app.requests',
        'app.clients',
        'app.roles',
        'app.users',
        'app.commune',
        'app.cities',
        'app.communes',
        'app.users_communes',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.cars',
        'app.items_logs',
        'app.request_services',
        'app.available_services',
        'app.items',
        'app.purcharse_order_items',
        'app.purcharse_orders',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.payment_methods',
        'app.payments',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.tools',
        'app.users_tools',
        'app.mechanics',
        'app.health_reports',
        'app.requests_files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestsAvailableServices') ? [] : ['className' => 'App\Model\Table\RequestsAvailableServicesTable'];
        $this->RequestsAvailableServices = TableRegistry::get('RequestsAvailableServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestsAvailableServices);

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
