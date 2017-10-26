<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HelpsWhen Entity
 *
 * @property int $id
 * @property int $helps_whatsup_id
 * @property string $when_name
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\HelpsWhatsup $helps_whatsup
 * @property \App\Model\Entity\HelpsSituation[] $helps_situations
 */
class HelpsWhen extends Entity
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
