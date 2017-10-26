<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HelpsWheresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HelpsWheresTable Test Case
 */
class HelpsWheresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HelpsWheresTable
     */
    public $HelpsWheres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.helps_wheres',
        'app.helps_whatsups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HelpsWheres') ? [] : ['className' => 'App\Model\Table\HelpsWheresTable'];
        $this->HelpsWheres = TableRegistry::get('HelpsWheres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HelpsWheres);

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
