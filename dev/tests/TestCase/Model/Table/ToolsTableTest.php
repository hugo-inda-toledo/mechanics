<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ToolsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ToolsTable Test Case
 */
class ToolsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ToolsTable
     */
    public $Tools;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tools',
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
        $config = TableRegistry::exists('Tools') ? [] : ['className' => 'App\Model\Table\ToolsTable'];
        $this->Tools = TableRegistry::get('Tools', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tools);

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
}
