<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HelpsWhensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HelpsWhensTable Test Case
 */
class HelpsWhensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HelpsWhensTable
     */
    public $HelpsWhens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.helps_whens',
        'app.helps_whatsups',
        'app.helps_wheres',
        'app.helps_situations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HelpsWhens') ? [] : ['className' => 'App\Model\Table\HelpsWhensTable'];
        $this->HelpsWhens = TableRegistry::get('HelpsWhens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HelpsWhens);

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
