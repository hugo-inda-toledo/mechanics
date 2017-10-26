<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProvidersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProvidersTable Test Case
 */
class ProvidersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProvidersTable
     */
    public $Providers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.providers',
        'app.cities',
        'app.communes',
        'app.requests',
        'app.clients',
        'app.roles',
        'app.users',
        'app.commune',
        'app.users_communes',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.cars',
        'app.car_brands',
        'app.car_models',
        'app.car_brands_providers',
        'app.replacements',
        'app.available_services',
        'app.requests_types',
        'app.request_services',
        'app.items_logs',
        'app.abilities',
        'app.available_services_abilities',
        'app.available_services_replacements',
        'app.supplies',
        'app.available_services_supplies',
        'app.supplies_providers',
        'app.requests_available_services',
        'app.purchase_orders',
        'app.purchase_orders_replacements',
        'app.purchase_orders_supplies',
        'app.replacements_providers',
        'app.health_reports',
        'app.maintence_records',
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.workloads',
        'app.tools',
        'app.users_tools',
        'app.payment_refunds',
        'app.banks',
        'app.unique_codes',
        'app.bank',
        'app.banks_codes',
        'app.codes',
        'app.providers_payment_refunds',
        'app.users_payment_refunds',
        'app.permissions',
        'app.roles_permissions',
        'app.mechanics',
        'app.payments',
        'app.payment_methods',
        'app.requests_files',
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
        $config = TableRegistry::exists('Providers') ? [] : ['className' => 'App\Model\Table\ProvidersTable'];
        $this->Providers = TableRegistry::get('Providers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Providers);

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
