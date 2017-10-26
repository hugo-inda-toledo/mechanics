<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TableGroups;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TableGroups Test Case
 */
class TableGroupsTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TableGroups
     */
    public $TableGroups;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Groups') ? [] : ['className' => 'App\Model\Table\TableGroups'];
        $this->TableGroups = TableRegistry::get('Groups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TableGroups);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
