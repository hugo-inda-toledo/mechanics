<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProvidersPaymentRefund Entity
 *
 * @property int $id
 * @property int $provider_id
 * @property int $payment_refund_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Provider $provider
 * @property \App\Model\Entity\PaymentRefund $payment_refund
 */
class ProvidersPaymentRefund extends Entity
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
