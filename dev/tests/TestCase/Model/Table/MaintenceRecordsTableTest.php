<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaintenceRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaintenceRecordsTable Test Case
 */
class MaintenceRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaintenceRecordsTable
     */
    public $MaintenceRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.maintence_records',
        'app.cars',
        'app.users',
        'app.roles',
        'app.commune',
        'app.cities',
        'app.communes',
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
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.health_reports',
        'app.payments',
        'app.payment_methods',
        'app.requests_files',
        'app.users_communes',
        'app.abilities',
        'app.schedules',
        'app.session',
        'app.workloads',
        'app.tools',
        'app.users_tools'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MaintenceRecords') ? [] : ['className' => 'App\Model\Table\MaintenceRecordsTable'];
        $this->MaintenceRecords = TableRegistry::get('MaintenceRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaintenceRecords);

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
