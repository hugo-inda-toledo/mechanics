<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersCommunesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersCommunesTable Test Case
 */
class UsersCommunesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersCommunesTable
     */
    public $UsersCommunes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_communes',
        'app.users',
        'app.user_types',
        'app.countries',
        'app.languages',
        'app.logs',
        'app.votings',
        'app.organizations',
        'app.organizations_users',
        'app.voting_tables',
        'app.users_voting_tables',
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
        'app.cars',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.health_reports',
        'app.payments',
        'app.payment_methods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersCommunes') ? [] : ['className' => 'App\Model\Table\UsersCommunesTable'];
        $this->UsersCommunes = TableRegistry::get('UsersCommunes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersCommunes);

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
