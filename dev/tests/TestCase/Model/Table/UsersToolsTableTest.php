<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersToolsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersToolsTable Test Case
 */
class UsersToolsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersToolsTable
     */
    public $UsersTools;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_tools',
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
        'app.tools'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersTools') ? [] : ['className' => 'App\Model\Table\UsersToolsTable'];
        $this->UsersTools = TableRegistry::get('UsersTools', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersTools);

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
