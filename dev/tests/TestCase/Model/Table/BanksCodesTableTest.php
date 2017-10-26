<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BanksCodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BanksCodesTable Test Case
 */
class BanksCodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BanksCodesTable
     */
    public $BanksCodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.banks_codes',
        'app.banks',
        'app.codes',
        'app.payment_refunds'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BanksCodes') ? [] : ['className' => 'App\Model\Table\BanksCodesTable'];
        $this->BanksCodes = TableRegistry::get('BanksCodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BanksCodes);

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
