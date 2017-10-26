<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RolesPermissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RolesPermissionsTable Test Case
 */
class RolesPermissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RolesPermissionsTable
     */
    public $RolesPermissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.roles_permissions',
        'app.roles',
        'app.users',
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
        'app.purcharse_order_items',
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
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.mechanics',
        'app.health_reports',
        'app.purchase_orders',
        'app.purchase_orders_items',
        'app.requests_files',
        'app.requests_available_services',
        'app.permissions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RolesPermissions') ? [] : ['className' => 'App\Model\Table\RolesPermissionsTable'];
        $this->RolesPermissions = TableRegistry::get('RolesPermissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RolesPermissions);

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
