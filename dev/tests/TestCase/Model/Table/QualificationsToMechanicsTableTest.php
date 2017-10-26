<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QualificationsToMechanicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QualificationsToMechanicsTable Test Case
 */
class QualificationsToMechanicsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QualificationsToMechanicsTable
     */
    public $QualificationsToMechanics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.qualifications_to_mechanics',
        'app.clients',
        'app.mechanics',
        'app.requests',
        'app.cars',
        'app.users',
        'app.roles',
        'app.commune',
        'app.cities',
        'app.communes',
        'app.users_communes',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
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
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.tools',
        'app.users_tools',
        'app.health_reports',
        'app.requests_files',
        'app.requests_available_services'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('QualificationsToMechanics') ? [] : ['className' => 'App\Model\Table\QualificationsToMechanicsTable'];
        $this->QualificationsToMechanics = TableRegistry::get('QualificationsToMechanics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QualificationsToMechanics);

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
