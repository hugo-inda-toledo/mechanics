<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnsweredQuestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnsweredQuestionsTable Test Case
 */
class AnsweredQuestionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnsweredQuestionsTable
     */
    public $AnsweredQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.answered_questions',
        'app.answered_surveys'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AnsweredQuestions') ? [] : ['className' => 'App\Model\Table\AnsweredQuestionsTable'];
        $this->AnsweredQuestions = TableRegistry::get('AnsweredQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AnsweredQuestions);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
