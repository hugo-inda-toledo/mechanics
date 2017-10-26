<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiagnosticsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DiagnosticsTable Test Case
 */
class DiagnosticsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DiagnosticsTable
     */
    public $Diagnostics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.diagnostics',
        'app.helps_wheres',
        'app.helps_whatsups',
        'app.helps_whens',
        'app.helps_situations',
        'app.helps_how_oftens',
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
        'app.car_brands',
        'app.car_models',
        'app.health_reports',
        'app.maintence_records',
        'app.items_logs',
        'app.request_services',
        'app.available_services',
        'app.items',
        'app.categories',
        'app.purcharse_order_items',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
        'app.payment_refunds',
        'app.banks',
        'app.unique_codes',
        'app.bank',
        'app.banks_codes',
        'app.codes',
        'app.providers_payment_refunds',
        'app.users_payment_refunds',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.tools',
        'app.users_tools',
        'app.permissions',
        'app.roles_permissions',
        'app.mechanics',
        'app.payments',
        'app.payment_methods',
        'app.purchase_orders',
        'app.purchase_orders_items',
        'app.requests_files',
        'app.requests_available_services',
        'app.qualifications_to_mechanics',
        'app.invoices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Diagnostics') ? [] : ['className' => 'App\Model\Table\DiagnosticsTable'];
        $this->Diagnostics = TableRegistry::get('Diagnostics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Diagnostics);

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
