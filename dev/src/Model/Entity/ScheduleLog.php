<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ScheduleLog Entity
 *
 * @property int $id
 * @property int $schedule_id
 * @property int $request_id
 * @property int $notified
 * @property int $answered
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Schedule $schedule
 * @property \App\Model\Entity\Request $request
 */
class ScheduleLog extends Entity
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
