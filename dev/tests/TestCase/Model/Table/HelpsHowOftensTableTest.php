<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HelpsHowOftensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HelpsHowOftensTable Test Case
 */
class HelpsHowOftensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HelpsHowOftensTable
     */
    public $HelpsHowOftens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.helps_how_oftens',
        'app.helps_situations',
        'app.helps_whens',
        'app.helps_whatsups',
        'app.helps_wheres'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HelpsHowOftens') ? [] : ['className' => 'App\Model\Table\HelpsHowOftensTable'];
        $this->HelpsHowOftens = TableRegistry::get('HelpsHowOftens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HelpsHowOftens);

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
