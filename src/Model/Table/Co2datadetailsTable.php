<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Co2datadetails Model
 *
 * @property \App\Model\Table\RoomInfoTable&\Cake\ORM\Association\BelongsTo $RoomInfo
 *
 * @method \App\Model\Entity\Co2datadetail newEmptyEntity()
 * @method \App\Model\Entity\Co2datadetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Co2datadetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Co2datadetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Co2datadetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Co2datadetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Co2datadetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Co2datadetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Co2datadetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Co2datadetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class Co2datadetailsTable extends Table
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

        $this->setTable('co2datadetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RoomInfo', [
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
        $rules->add($rules->existsIn(['co2_device_id'], 'RoomInfo'), ['errorField' => 'co2_device_id']);

        return $rules;
    }
}
