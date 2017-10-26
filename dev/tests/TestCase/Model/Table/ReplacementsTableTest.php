<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReplacementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReplacementsTable Test Case
 */
class ReplacementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReplacementsTable
     */
    public $Replacements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.replacements',
        'app.car_brands_providers',
        'app.car_brands',
        'app.car_models',
        'app.cars',
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
        'app.items_logs',
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.payment_refunds',
        'app.banks',
        'app.unique_codes',
        'app.bank',
        'app.banks_codes',
        'app.codes',
        'app.providers',
        'app.purchase_orders_replacements',
        'app.purchase_orders',
        'app.supplies',
        'app.available_services',
        'app.requests_types',
        'app.request_services',
        'app.available_services_abilities',
        'app.available_services_replacements',
        'app.available_services_supplies',
        'app.requests_available_services',
        'app.supplies_providers',
        'app.purchase_orders_supplies',
        'app.providers_payment_refunds',
        'app.replacements_providers',
        'app.users_payment_refunds',
        'app.mechanics',
        'app.health_reports',
        'app.payments',
        'app.payment_methods',
        'app.requests_files',
        'app.qualifications_to_mechanics',
        'app.invoices',
        'app.maintence_records'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Replacements') ? [] : ['className' => 'App\Model\Table\ReplacementsTable'];
        $this->Replacements = TableRegistry::get('Replacements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Replacements);

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
