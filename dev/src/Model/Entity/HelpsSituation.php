<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HelpsSituation Entity
 *
 * @property int $id
 * @property int $helps_when_id
 * @property string $situation_name
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\HelpsWhen $helps_when
 * @property \App\Model\Entity\HelpsHowOften[] $helps_how_oftens
 */
class HelpsSituation extends Entity
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
