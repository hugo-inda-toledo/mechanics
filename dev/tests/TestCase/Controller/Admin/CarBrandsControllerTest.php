<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\CarBrandsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\CarBrandsController Test Case
 */
class CarBrandsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.available_services_abilities',
        'app.available_services',
        'app.requests_types',
        'app.request_services',
        'app.replacements',
        'app.car_brands_providers',
        'app.providers',
        'app.purchase_orders_replacements',
        'app.purchase_orders',
        'app.supplies',
        'app.available_services_supplies',
        'app.supplies_providers',
        'app.purchase_orders_supplies',
        'app.payment_refunds',
        'app.banks',
        'app.unique_codes',
        'app.bank',
        'app.banks_codes',
        'app.codes',
        'app.providers_payment_refunds',
        'app.users_payment_refunds',
        'app.mechanics',
        'app.workloads',
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.replacements_providers',
        'app.available_services_replacements',
        'app.requests_available_services',
        'app.health_reports',
        'app.payments',
        'app.payment_methods',
        'app.requests_files',
        'app.qualifications_to_mechanics',
        'app.invoices',
        'app.maintence_records'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
