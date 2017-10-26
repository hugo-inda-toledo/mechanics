<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WorkloadsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WorkloadsController Test Case
 */
class WorkloadsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workloads',
        'app.users',
        'app.roles',
        'app.abilities',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.requests',
        'app.requests_types',
        'app.available_services',
        'app.request_services',
        'app.items_logs',
        'app.items',
        'app.purcharse_order_items',
        'app.purcharse_orders',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
        'app.requests_types_available_services',
        'app.cars',
        'app.communes',
        'app.users_communes',
        'app.health_reports',
        'app.payments',
        'app.payment_methods',
        'app.schedules',
        'app.session',
        'app.tools',
        'app.users_tools'
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
