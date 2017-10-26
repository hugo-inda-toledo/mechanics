<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReportQuestionGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReportQuestionGroupsTable Test Case
 */
class ReportQuestionGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReportQuestionGroupsTable
     */
    public $ReportQuestionGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.report_question_groups',
        'app.report_questions',
        'app.report_question_categories',
        'app.report_question_answers',
        'app.report_question_alternatives'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReportQuestionGroups') ? [] : ['className' => 'App\Model\Table\ReportQuestionGroupsTable'];
        $this->ReportQuestionGroups = TableRegistry::get('ReportQuestionGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReportQuestionGroups);

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
