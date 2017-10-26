<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Car Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $car_brand_id
 * @property int $car_model_id
 * @property string $patent
 * @property int $year
 * @property int $mileage
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $observations
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CarBrand $car_brand
 * @property \App\Model\Entity\CarModel $car_model
 * @property \App\Model\Entity\HealthReport[] $health_reports
 * @property \App\Model\Entity\MaintenceRecord[] $maintence_records
 * @property \App\Model\Entity\Request[] $requests
 */
class Car extends Entity
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
