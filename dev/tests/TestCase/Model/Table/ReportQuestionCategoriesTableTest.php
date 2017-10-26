<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReportQuestionCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReportQuestionCategoriesTable Test Case
 */
class ReportQuestionCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReportQuestionCategoriesTable
     */
    public $ReportQuestionCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.report_question_categories',
        'app.report_question_answers',
        'app.report_questions',
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
        $config = TableRegistry::exists('ReportQuestionCategories') ? [] : ['className' => 'App\Model\Table\ReportQuestionCategoriesTable'];
        $this->ReportQuestionCategories = TableRegistry::get('ReportQuestionCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReportQuestionCategories);

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
