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
     * Sets up the model's configuration, table name, display field, primary key,
     * and defines relationships to Contractors and Skills tables.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Define the database table used by this model
        $this->setTable('contractors_skills');

        // Define the display field for the model
        $this->setDisplayField('id');

        // Define the primary key for the model
        $this->setPrimaryKey('id');

        // Set up belongsTo association with Contractors table
        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractor_id',
        ]);

        // Set up belongsTo association with Skills table
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
        ]);
    }

    /**
     * Default validation rules
     *
     * Defines validation rules to ensure data integrity for the contractor_id and skill_id fields.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validate contractor_id as an integer, allowing it to be empty
        $validator
            ->integer('contractor_id')
            ->allowEmptyString('contractor_id');

        // Validate skill_id as an integer, allowing it to be empty
        $validator
            ->integer('skill_id')
            ->allowEmptyString('skill_id');

        return $validator;
    }

    /**
     * Build rules method
     *
     * Defines application integrity rules to ensure that contractor_id and skill_id
     * reference existing records in Contractors and Skills tables, respectively.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Ensure contractor_id exists in the Contractors table
        $rules->add($rules->existsIn(['contractor_id'], 'Contractors'), ['errorField' => 'contractor_id']);

        // Ensure skill_id exists in the Skills table
        $rules->add($rules->existsIn(['skill_id'], 'Skills'), ['errorField' => 'skill_id']);

        return $rules;
    }
}
