<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SuppliesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SuppliesTable Test Case
 */
class SuppliesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SuppliesTable
     */
    public $Supplies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.supplies',
        'app.available_services',
        'app.requests_types',
        'app.request_services',
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
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.tools',
        'app.users_tools',
        'app.payment_refunds',
        'app.banks',
        'app.unique_codes',
        'app.bank',
        'app.banks_codes',
        'app.codes',
        'app.providers',
        'app.items',
        'app.providers_items',
        'app.providers_payment_refunds',
        'app.users_payment_refunds',
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
        'app.invoices',
        'app.available_services_abilities',
        'app.replacements',
        'app.car_brands_providers',
        'app.available_services_replacements',
        'app.purchase_orders_replacements',
        'app.replacements_providers',
        'app.available_services_supplies',
        'app.supplies_providers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Supplies') ? [] : ['className' => 'App\Model\Table\SuppliesTable'];
        $this->Supplies = TableRegistry::get('Supplies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Supplies);

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
