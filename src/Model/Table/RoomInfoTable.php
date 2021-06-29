<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoomInfo Model
 *
 * @method \App\Model\Entity\RoomInfo newEmptyEntity()
 * @method \App\Model\Entity\RoomInfo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RoomInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoomInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoomInfo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RoomInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoomInfo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoomInfo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoomInfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoomInfo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RoomInfo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RoomInfo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RoomInfo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RoomInfoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('room_info');
        $this->setDisplayField('id');
        $this->setPrimaryKey('device_id');

        $this->hasMany('Co2datadetails', [
            'foreignKey' => 'co2_device_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        /* $validator
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmptyString('id')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']); */

        $validator
            ->scalar('device_id')
            ->maxLength('device_id', 255)
            ->requirePresence('device_id', 'create')
            ->notEmptyString('device_id')
            ->add('device_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('user_uid')
            ->maxLength('user_uid', 255)
            ->requirePresence('user_uid', 'create')
            ->notEmptyString('user_uid');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 255)
            ->requirePresence('postal_code', 'create')
            ->notEmptyString('postal_code');

        $validator
            ->scalar('prefecture')
            ->maxLength('prefecture', 255)
            ->requirePresence('prefecture', 'create')
            ->notEmptyString('prefecture');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('room_no')
            ->maxLength('room_no', 255)
            ->requirePresence('room_no', 'create')
            ->notEmptyString('room_no');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);
        $rules->add($rules->isUnique(['device_id']), ['errorField' => 'device_id']);

        return $rules;
    }
}
