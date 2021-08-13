<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Co2datadetailsHistory Model
 *
 * @property \App\Model\Table\Co2DevicesTable&\Cake\ORM\Association\BelongsTo $Co2Devices
 *
 * @method \App\Model\Entity\Co2datadetailsHistory newEmptyEntity()
 * @method \App\Model\Entity\Co2datadetailsHistory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Co2datadetailsHistory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class Co2datadetailsHistoryTable extends Table
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

        $this->setTable('co2datadetails_history');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Co2Devices', [
            'foreignKey' => 'co2_device_id',
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
        $validator
            ->scalar('id')
            ->maxLength('id', 255)
            ->allowEmptyString('id', null, 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->numeric('temperature')
            ->allowEmptyString('temperature');

        $validator
            ->numeric('humidity')
            ->allowEmptyString('humidity');

        $validator
            ->numeric('co2')
            ->allowEmptyString('co2');

        $validator
            ->numeric('noise')
            ->allowEmptyString('noise');

        $validator
            ->dateTime('time_measured')
            ->allowEmptyDateTime('time_measured');

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
        $rules->add($rules->existsIn(['co2_device_id'], 'Co2Devices'), ['errorField' => 'co2_device_id']);

        return $rules;
    }
}
