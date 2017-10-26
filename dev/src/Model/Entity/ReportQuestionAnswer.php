<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReportQuestionAnswer Entity
 *
 * @property int $id
 * @property int $report_question_id
 * @property int $report_question_alternative_id
 * @property int $report_question_category_id
 * @property int $score
 * @property \Cake\I18n\Time $created
 * @property int $report_id
 * @property int $report_question_group_id
 *
 * @property \App\Model\Entity\ReportQuestion $report_question
 * @property \App\Model\Entity\ReportQuestionAlternative $report_question_alternative
 * @property \App\Model\Entity\ReportQuestionCategory $report_question_category
 * @property \App\Model\Entity\Report $report
 */
class ReportQuestionAnswer extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
