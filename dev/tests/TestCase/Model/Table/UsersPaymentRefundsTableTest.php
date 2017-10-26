<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersPaymentRefundsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersPaymentRefundsTable Test Case
 */
class UsersPaymentRefundsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersPaymentRefundsTable
     */
    public $UsersPaymentRefunds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_payment_refunds',
        'app.users',
        'app.roles',
        'app.permissions',
        'app.roles_permissions',
        'app.commune',
        'app.cities',
        'app.communes',
        'app.requests',
        'app.clients',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.cars',
        'app.items_logs',
        'app.request_services',
        'app.available_services',
        'app.items',
        'app.categories',
        'app.purcharse_order_items',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.mechanics',
        'app.health_reports',
        'app.payments',
        'app.payment_methods',
        'app.purchase_orders',
        'app.purchase_orders_items',
        'app.requests_files',
        'app.requests_available_services',
        'app.qualifications_to_mechanics',
        'app.payment_refunds',
        'app.banks',
        'app.codes',
        'app.banks_codes',
        'app.providers_payment_refunds'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersPaymentRefunds') ? [] : ['className' => 'App\Model\Table\UsersPaymentRefundsTable'];
        $this->UsersPaymentRefunds = TableRegistry::get('UsersPaymentRefunds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersPaymentRefunds);

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
