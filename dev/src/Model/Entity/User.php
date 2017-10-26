<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone1
 * @property string $phone2
 * @property int $commune_id
 * @property int $city_id
 * @property string $password
 * @property string $photo_url
 * @property string $sex
 * @property bool $active
 * @property string $id_fcm1
 * @property string $id_fcm2
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Commune $commune
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Ability[] $abilities
 * @property \App\Model\Entity\AnsweredSurvey[] $answered_surveys
 * @property \App\Model\Entity\Car[] $cars
 * @property \App\Model\Entity\ItemsLog[] $items_logs
 * @property \App\Model\Entity\PaymentMethod[] $payment_methods
 * @property \App\Model\Entity\Schedule[] $schedules
 * @property \App\Model\Entity\Session[] $session
 * @property \App\Model\Entity\Workload[] $workloads
 * @property \App\Model\Entity\Commune[] $communes
 * @property \App\Model\Entity\Tool[] $tools
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected $_virtual = [
        'full_name'
    ];


    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }

    protected function _getFullName()
    {
        return $this->_properties['name'] . ' ' . $this->_properties['last_name'];
    }
}
