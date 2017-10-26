<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Banks Model
 *
 * @property \Cake\ORM\Association\HasMany $Codes
 * @property \Cake\ORM\Association\HasMany $PaymentRefunds
 * @property \Cake\ORM\Association\BelongsToMany $Codes
 *
 * @method \App\Model\Entity\Bank get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bank newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bank[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bank|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bank[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bank findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BanksTable extends Table
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

        $this->table('banks');
        $this->displayField('short_name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('UniqueCodes', [
            'className' => 'Codes',
            'foreignKey' => 'bank_id'
        ]);
        $this->hasMany('PaymentRefunds', [
            'foreignKey' => 'bank_id'
        ]);
        $this->belongsToMany('Codes', [
            'foreignKey' => 'bank_id',
            'targetForeignKey' => 'code_id',
            'joinTable' => 'banks_codes'
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
            ->requirePresence('short_name', 'create')
            ->notEmpty('short_name');

        $validator
            ->allowEmpty('long_name');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('enabled_to_export')
            ->requirePresence('enabled_to_export', 'create')
            ->notEmpty('enabled_to_export');

        $validator
            ->integer('origin_account_number')
            ->allowEmpty('origin_account_number');

        return $validator;
    }
}
