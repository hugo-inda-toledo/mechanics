<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CarBrandsProvider Entity
 *
 * @property int $id
 * @property int $car_brand_id
 * @property int $provider_id
 * @property int $replacement_id
 * @property int $stock
 * @property int $default_provider
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\CarBrand $car_brand
 * @property \App\Model\Entity\Provider $provider
 * @property \App\Model\Entity\Replacement $replacement
 */
class CarBrandsProvider extends Entity
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
