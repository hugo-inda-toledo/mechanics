<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Provider Entity
 *
 * @property int $id
 * @property int $city_id
 * @property int $commune_id
 * @property string $name
 * @property string $contact_name
 * @property string $address
 * @property string $dni
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Commune $commune
 * @property \App\Model\Entity\PurchaseOrdersReplacement[] $purchase_orders_replacements
 * @property \App\Model\Entity\PurchaseOrdersSupply[] $purchase_orders_supplies
 * @property \App\Model\Entity\CarBrand[] $car_brands
 * @property \App\Model\Entity\PaymentRefund[] $payment_refunds
 * @property \App\Model\Entity\Replacement[] $replacements
 * @property \App\Model\Entity\Supply[] $supplies
 */
class Provider extends Entity
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
