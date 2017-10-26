<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RequestsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RequestsController Test Case
 */
class RequestsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requests',
        'app.clients',
        'app.roles',
        'app.users',
        'app.commune',
        'app.cities',
        'app.communes',
        'app.users_communes',
        'app.mechanics',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.cars',
        'app.items_logs',
        'app.request_services',
        'app.available_services',
        'app.items',
        'app.purcharse_order_items',
        'app.purcharse_orders',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.requests_available_services',
        'app.payment_methods',
        'app.payments',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.tools',
        'app.users_tools',
        'app.health_reports',
        'app.requests_files'
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

    /**
     * Test ask method
     *
     * @return void
     */
    public function testAsk()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test acceptModByClient method
     *
     * @return void
     */
    public function testAcceptModByClient()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test acceptRequestByMechanic method
     *
     * @return void
     */
    public function testAcceptRequestByMechanic()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test editMechanic method
     *
     * @return void
     */
    public function testEditMechanic()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test modByMechanic method
     *
     * @return void
     */
    public function testModByMechanic()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getPdfRequest method
     *
     * @return void
     */
    public function testGetPdfRequest()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test cancelByClient method
     *
     * @return void
     */
    public function testCancelByClient()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test cancelByMechanic method
     *
     * @return void
     */
    public function testCancelByMechanic()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
