<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\UsersPaymentRefundsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\UsersPaymentRefundsController Test Case
 */
class UsersPaymentRefundsControllerTest extends IntegrationTestCase
{

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
        'app.providers_payment_refunds',
        'app.payment_refunds',
        'app.banks',
        'app.codes',
        'app.banks_codes',
        'app.purchase_orders_items',
        'app.purchase_orders',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.requests_available_services',
        'app.payment_method',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.users_communes',
        'app.mechanics',
        'app.tools',
        'app.users_tools',
        'app.health_reports',
        'app.payments',
        'app.payment_methods',
        'app.requests_files',
        'app.qualifications_to_mechanics'
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
