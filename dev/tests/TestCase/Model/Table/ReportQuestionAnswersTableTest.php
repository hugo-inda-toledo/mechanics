<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReportQuestionAnswersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReportQuestionAnswersTable Test Case
 */
class ReportQuestionAnswersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReportQuestionAnswersTable
     */
    public $ReportQuestionAnswers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.report_question_answers',
        'app.report_questions',
        'app.report_question_categories',
        'app.report_question_alternatives',
        'app.reports',
        'app.users',
        'app.roles',
        'app.permissions',
        'app.roles_permissions',
        'app.commune',
        'app.cities',
        'app.communes',
        'app.requests',
        'app.clients',
        'app.answered_surveys',
        'app.surveys',
        'app.questions',
        'app.cars',
        'app.items_logs',
        'app.request_services',
        'app.available_services',
        'app.items',
        'app.purcharse_order_items',
        'app.available_services_items',
        'app.providers',
        'app.providers_items',
        'app.categories',
        'app.requests_types',
        'app.requests_types_available_services',
        'app.payment_methods',
        'app.payments',
        'app.schedules',
        'app.session',
        'app.user_abilities',
        'app.abilities',
        'app.workloads',
        'app.users_communes',
        'app.tools',
        'app.users_tools',
        'app.mechanics',
        'app.health_reports',
        'app.purchase_orders',
        'app.purchase_orders_items',
        'app.requests_files',
        'app.requests_available_services',
        'app.qualifications_to_mechanics'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReportQuestionAnswers') ? [] : ['className' => 'App\Model\Table\ReportQuestionAnswersTable'];
        $this->ReportQuestionAnswers = TableRegistry::get('ReportQuestionAnswers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReportQuestionAnswers);

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
