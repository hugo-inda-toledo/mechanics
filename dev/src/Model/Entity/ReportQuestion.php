<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReportQuestion Entity
 *
 * @property int $id
 * @property string $content
 * @property int $report_question_category_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $active
 * @property int $report_question_group_id
 * @property string $tips
 * @property string $obs
 * @property int $type
 *
 * @property \App\Model\Entity\ReportQuestionCategory $report_question_category
 * @property \App\Model\Entity\ReportQuestionGroup $report_question_group
 * @property \App\Model\Entity\ReportQuestionAlternative[] $report_question_alternatives
 * @property \App\Model\Entity\ReportQuestionAnswer[] $report_question_answers
 */
class ReportQuestion extends Entity
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
