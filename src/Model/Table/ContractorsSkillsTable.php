<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContractorsSkills Model
 *
 * @property \App\Model\Table\ContractorsTable&\Cake\ORM\Association\BelongsTo $Contractors
 * @property \App\Model\Table\SkillsTable&\Cake\ORM\Association\BelongsTo $Skills
 *
 * @method \App\Model\Entity\ContractorsSkill newEmptyEntity()
 * @method \App\Model\Entity\ContractorsSkill newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ContractorsSkill> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContractorsSkill get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ContractorsSkill findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ContractorsSkill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ContractorsSkill> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContractorsSkill|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ContractorsSkill saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ContractorsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContractorsSkill>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContractorsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContractorsSkill> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContractorsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContractorsSkill>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContractorsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContractorsSkill> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ContractorsSkillsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('contractors_skills');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
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
            ->integer('contractor_id')
            ->allowEmptyString('contractor_id');

        $validator
            ->integer('skill_id')
            ->allowEmptyString('skill_id');

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
        $rules->add($rules->existsIn(['contractor_id'], 'Contractors'), ['errorField' => 'contractor_id']);
        $rules->add($rules->existsIn(['skill_id'], 'Skills'), ['errorField' => 'skill_id']);

        return $rules;
    }
}
