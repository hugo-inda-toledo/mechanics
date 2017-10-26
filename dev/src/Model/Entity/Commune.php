<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Commune Entity
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $city_id
 *
 * @property \App\Model\Entity\Request[] $requests
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\City[] $cities
 */
class Commune extends Entity
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
