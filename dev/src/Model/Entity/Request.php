<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property int $client_id
 * @property int $mechanic_id
 * @property int $car_id
 * @property string $address_name
 * @property int $address_number
 * @property string $address_complement
 * @property int $city_id
 * @property int $commune_id
 * @property int $status
 * @property bool $active
 * @property \Cake\I18n\Time $start_time_schedule_requested
 * @property string $type_documents_payment
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $client
 * @property \App\Model\Entity\User $mechanic
 * @property \App\Model\Entity\RequestsType $requests_type
 * @property \App\Model\Entity\Car $car
 * @property \App\Model\Entity\Commune $commune
 * @property \App\Model\Entity\AnsweredSurvey[] $answered_surveys
 * @property \App\Model\Entity\HealthReport[] $health_reports
 * @property \App\Model\Entity\ItemsLog[] $items_logs
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\PurcharseOrder[] $purcharse_orders
 * @property \App\Model\Entity\RequestService[] $request_services
 * @property \App\Model\Entity\RequestsFile[] $requests_files
 * @property \App\Model\Entity\AvailableService[] $available_services
 */
class Request extends Entity
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
