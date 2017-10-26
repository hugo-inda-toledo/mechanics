<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReplacementsProvidersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReplacementsProvidersTable Test Case
 */
class ReplacementsProvidersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReplacementsProvidersTable
     */
    public $ReplacementsProviders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.replacements_providers',
        'app.providers',
        'app.items',
        'app.providers_items',
        'app.payment_refunds',
        'app.banks',
        'app.unique_codes',
        'app.bank',
        'app.banks_codes',
        'app.codes',
        'app.providers_payment_refunds',
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
        'app.purchase_orders_items',
        'app.purchase_orders_replacements',
        'app.health_reports',
        'app.maintence_records',
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.workloads',
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.users_payment_refunds',
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
        $config = TableRegistry::exists('ReplacementsProviders') ? [] : ['className' => 'App\Model\Table\ReplacementsProvidersTable'];
        $this->ReplacementsProviders = TableRegistry::get('ReplacementsProviders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReplacementsProviders);

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
