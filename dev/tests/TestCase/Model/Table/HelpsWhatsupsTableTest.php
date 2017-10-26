<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HelpsWhatsupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HelpsWhatsupsTable Test Case
 */
class HelpsWhatsupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HelpsWhatsupsTable
     */
    public $HelpsWhatsups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.helps_whatsups',
        'app.helps_wheres',
        'app.helps_whens'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HelpsWhatsups') ? [] : ['className' => 'App\Model\Table\HelpsWhatsupsTable'];
        $this->HelpsWhatsups = TableRegistry::get('HelpsWhatsups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HelpsWhatsups);

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
