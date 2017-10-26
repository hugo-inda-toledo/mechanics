<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestsMechanicModItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestsMechanicModItemsTable Test Case
 */
class RequestsMechanicModItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestsMechanicModItemsTable
     */
    public $RequestsMechanicModItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requests_mechanic_mod_items',
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
        'app.providers',
        'app.purchase_orders_replacements',
        'app.purchase_orders',
        'app.replacements',
        'app.car_brands_providers',
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
        'app.replacements_providers',
        'app.purchase_orders_supplies',
        'app.payment_refunds',
        'app.banks',
        'app.unique_codes',
        'app.bank',
        'app.banks_codes',
        'app.codes',
        'app.providers_payment_refunds',
        'app.users_payment_refunds',
        'app.health_reports',
        'app.maintence_records',
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.workloads',
        'app.tools',
        'app.users_tools',
        'app.permissions',
        'app.roles_permissions',
        'app.mechanics',
        'app.payments',
        'app.payment_methods',
        'app.requests_files',
        'app.qualifications_to_mechanics',
        'app.invoices',
        'app.reports',
        'app.report_question_categories',
        'app.report_question_answers',
        'app.report_questions',
        'app.report_question_groups',
        'app.report_question_alternatives',
        'app.requests_mechanic_mods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestsMechanicModItems') ? [] : ['className' => 'App\Model\Table\RequestsMechanicModItemsTable'];
        $this->RequestsMechanicModItems = TableRegistry::get('RequestsMechanicModItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestsMechanicModItems);

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
