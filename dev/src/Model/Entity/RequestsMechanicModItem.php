<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequestsMechanicModItem Entity
 *
 * @property int $id
 * @property int $request_id
 * @property int $request_mechanic_mod_id
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 * @property bool $active
 *
 * @property \App\Model\Entity\Request $request
 * @property \App\Model\Entity\RequestsMechanicMod $requests_mechanic_mod
 */
class RequestsMechanicModItem extends Entity
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
