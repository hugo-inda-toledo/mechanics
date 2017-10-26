<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AvailableService Entity
 *
 * @property int $id
 * @property int $requests_type_id
 * @property string $name
 * @property string $description
 * @property float $estimated_time
 * @property float $real_estimated_time
 * @property float $total_price
 * @property float $supplies_price
 * @property float $replacements_price
 * @property float $mechanic_pay
 * @property bool $active
 * @property bool $inspection
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\RequestsType $requests_type
 * @property \App\Model\Entity\RequestService[] $request_services
 * @property \App\Model\Entity\Ability[] $abilities
 * @property \App\Model\Entity\Replacement[] $replacements
 * @property \App\Model\Entity\Supply[] $supplies
 * @property \App\Model\Entity\Request[] $requests
 */
class AvailableService extends Entity
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
