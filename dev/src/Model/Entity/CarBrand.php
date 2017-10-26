<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CarBrand Entity
 *
 * @property int $id
 * @property string $brand_name
 * @property string $brand_logo
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\CarModel[] $car_models
 * @property \App\Model\Entity\Car[] $cars
 * @property \App\Model\Entity\Provider[] $providers
 * @property \App\Model\Entity\Replacement[] $replacements
 */
class CarBrand extends Entity
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
