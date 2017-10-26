<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentRefunds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Banks
 * @property \Cake\ORM\Association\BelongsToMany $Providers
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\PaymentRefund get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaymentRefund newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PaymentRefund[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentRefund|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentRefund patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentRefund[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentRefund findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentRefundsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('payment_refunds');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Banks', [
            'foreignKey' => 'bank_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Providers', [
            'foreignKey' => 'payment_refund_id',
            'targetForeignKey' => 'provider_id',
            'joinTable' => 'providers_payment_refunds'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'payment_refund_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_payment_refunds'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('account_number')
            ->requirePresence('account_number', 'create')
            ->notEmpty('account_number');

        $validator
            ->integer('dni')
            ->allowEmpty('dni');

        $validator
            ->allowEmpty('name');

        $validator
            ->email('email')
            ->allowEmpty('email');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['bank_id'], 'Banks'));

        return $rules;
    }
}
