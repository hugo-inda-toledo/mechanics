<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReportQuestionAlternativesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReportQuestionAlternativesTable Test Case
 */
class ReportQuestionAlternativesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReportQuestionAlternativesTable
     */
    public $ReportQuestionAlternatives;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.report_question_alternatives',
        'app.report_questions',
        'app.report_question_categories',
        'app.report_question_answers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReportQuestionAlternatives') ? [] : ['className' => 'App\Model\Table\ReportQuestionAlternativesTable'];
        $this->ReportQuestionAlternatives = TableRegistry::get('ReportQuestionAlternatives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReportQuestionAlternatives);

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
