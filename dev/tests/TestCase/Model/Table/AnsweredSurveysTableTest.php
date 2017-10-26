<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnsweredSurveysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnsweredSurveysTable Test Case
 */
class AnsweredSurveysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnsweredSurveysTable
     */
    public $AnsweredSurveys;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.answered_surveys',
        'app.surveys',
        'app.users',
        'app.user_types',
        'app.countries',
        'app.languages',
        'app.logs',
        'app.votings',
        'app.organizations',
        'app.organizations_users',
        'app.voting_tables',
        'app.users_voting_tables',
        'app.requests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AnsweredSurveys') ? [] : ['className' => 'App\Model\Table\AnsweredSurveysTable'];
        $this->AnsweredSurveys = TableRegistry::get('AnsweredSurveys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AnsweredSurveys);

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
