<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestsFilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestsFilesTable Test Case
 */
class RequestsFilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestsFilesTable
     */
    public $RequestsFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requests_files',
        'app.requests',
        'app.users',
        'app.roles',
        'app.abilities',
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
        'app.payment_methods',
        'app.payments',
        'app.schedules',
        'app.session',
        'app.workloads',
        'app.communes',
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.health_reports'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestsFiles') ? [] : ['className' => 'App\Model\Table\RequestsFilesTable'];
        $this->RequestsFiles = TableRegistry::get('RequestsFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestsFiles);

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
