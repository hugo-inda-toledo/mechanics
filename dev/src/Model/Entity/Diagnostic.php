<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Diagnostic Entity
 *
 * @property int $id
 * @property int $helps_where_id
 * @property int $helps_whatsup_id
 * @property int $helps_when_id
 * @property int $helps_situation_id
 * @property int $helps_how_often_id
 * @property int $request_id
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\HelpsWhere $helps_where
 * @property \App\Model\Entity\HelpsWhatsup $helps_whatsup
 * @property \App\Model\Entity\HelpsWhen $helps_when
 * @property \App\Model\Entity\HelpsSituation $helps_situation
 * @property \App\Model\Entity\HelpsHowOften $helps_how_often
 * @property \App\Model\Entity\Request $request
 */
class Diagnostic extends Entity
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
