<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Skills Model
 *
 * @property \App\Model\Table\ProjectsTable&\Cake\ORM\Association\BelongsToMany $Projects
 *
 * @method \App\Model\Entity\Skill newEmptyEntity()
 * @method \App\Model\Entity\Skill newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Skill> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Skill get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Skill findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Skill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Skill> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Skill|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Skill saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Skill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Skill>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Skill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Skill> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Skill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Skill>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Skill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Skill> deleteManyOrFail(iterable $entities, array $options = [])
 */
class SkillsTable extends Table
{
    /**
     * Initialize method
     *
     * Configures the table settings, including table name, display field, primary key, and relationships.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Sets the name of the table in the database
        $this->setTable('skills');
        // Sets the field to be displayed when a skill is referenced
        $this->setDisplayField('skill_name');
        // Defines the primary key for the table
        $this->setPrimaryKey('id');

        // Defines a many-to-many relationship with the Contractors table through the contractors_skills join table
        $this->belongsToMany('Contractors', [
            'joinTable' => 'contractors_skills',
            'foreignKey' => 'skill_id',
            'targetForeignKey' => 'contractor_id',
        ]);

        // Defines a many-to-many relationship with the Projects table through the projects_skills join table
        $this->belongsToMany('Projects', [
            'joinTable' => 'projects_skills',
            'foreignKey' => 'skill_id',
            'targetForeignKey' => 'project_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * Sets validation rules for the skill entity, including rules for the skill name's data type, length,
     * and uniqueness.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            // Ensures the skill_name field is a string and has a maximum length of 255 characters
            ->scalar('skill_name')
            ->maxLength('skill_name', 255)
            ->allowEmptyString('skill_name')
            // Ensures the skill name is unique across records
            ->add('skill_name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating application integrity.
     *
     * Enforces rules that ensure the data integrity, such as making sure each skill name is unique.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Adds a rule that the skill name must be unique, allowing multiple NULL values
        $rules->add($rules->isUnique(['skill_name'], ['allowMultipleNulls' => true]), ['errorField' => 'skill_name']);

        return $rules;
    }
}
