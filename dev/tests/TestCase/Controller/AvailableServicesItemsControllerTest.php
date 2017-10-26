<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AvailableServicesItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AvailableServicesItemsController Test Case
 */
class AvailableServicesItemsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.available_services_items',
        'app.available_services',
        'app.request_services',
        'app.requests',
        'app.users',
        'app.roles',
        'app.abilities',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.cars',
        'app.items_logs',
        'app.items',
        'app.purcharse_order_items',
        'app.purcharse_orders',
        'app.providers',
        'app.providers_items',
        'app.payment_methods',
        'app.payments',
        'app.schedules',
        'app.session',
        'app.workloads',
        'app.communes',
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.health_reports'
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
