<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkloadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkloadsTable Test Case
 */
class WorkloadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkloadsTable
     */
    public $Workloads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workloads',
        'app.users',
        'app.user_types',
        'app.countries',
        'app.languages',
        'app.logs',
        'app.votings',
        'app.organizations',
        'app.organizations_users',
        'app.voting_tables',
        'app.users_voting_tables'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Workloads') ? [] : ['className' => 'App\Model\Table\WorkloadsTable'];
        $this->Workloads = TableRegistry::get('Workloads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Workloads);

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
