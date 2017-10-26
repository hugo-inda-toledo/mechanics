<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HelpsSituationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HelpsSituationsTable Test Case
 */
class HelpsSituationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HelpsSituationsTable
     */
    public $HelpsSituations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.helps_situations',
        'app.helps_whens',
        'app.helps_whatsups',
        'app.helps_wheres',
        'app.helps_how_oftens'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HelpsSituations') ? [] : ['className' => 'App\Model\Table\HelpsSituationsTable'];
        $this->HelpsSituations = TableRegistry::get('HelpsSituations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HelpsSituations);

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
