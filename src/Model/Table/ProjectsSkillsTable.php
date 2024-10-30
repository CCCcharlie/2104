<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectsSkills Model
 *
 * @property \App\Model\Table\ProjectsTable&\Cake\ORM\Association\BelongsTo $Projects
 * @property \App\Model\Table\SkillsTable&\Cake\ORM\Association\BelongsTo $Skills
 *
 * @method \App\Model\Entity\ProjectsSkill newEmptyEntity()
 * @method \App\Model\Entity\ProjectsSkill newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProjectsSkill> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsSkill get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProjectsSkill findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProjectsSkill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProjectsSkill> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsSkill|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProjectsSkill saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProjectsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProjectsSkill>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProjectsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProjectsSkill> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProjectsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProjectsSkill>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProjectsSkill>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProjectsSkill> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProjectsSkillsTable extends Table
{
    /**
     * Initialize method
     *
     * Sets up the table configuration, associations, and display properties.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Set the name of the table in the database
        $this->setTable('projects_skills');

        // Set the field used to display records in views
        $this->setDisplayField('id');

        // Define the primary key for this table
        $this->setPrimaryKey('id');

        // Define a many-to-one association with the Projects table
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER', // Ensures each ProjectsSkills entry has an associated Project
        ]);

        // Define a many-to-one association with the Skills table
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'joinType' => 'INNER', // Ensures each ProjectsSkills entry has an associated Skill
        ]);
    }

    /**
     * Default validation rules
     *
     * Specifies validation rules for the project_id and skill_id fields.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Require project_id to be an integer and not empty
        $validator
            ->integer('project_id')
            ->notEmptyString('project_id', 'Project ID is required.');

        // Require skill_id to be an integer and not empty
        $validator
            ->integer('skill_id')
            ->notEmptyString('skill_id', 'Skill ID is required.');

        return $validator;
    }

    /**
     * Returns a rules checker object for application integrity validation
     *
     * Validates that project_id and skill_id reference existing records in their
     * respective tables.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Ensure that the project_id exists in the Projects table
        $rules->add($rules->existsIn(['project_id'], 'Projects'), ['errorField' => 'project_id']);

        // Ensure that the skill_id exists in the Skills table
        $rules->add($rules->existsIn(['skill_id'], 'Skills'), ['errorField' => 'skill_id']);

        return $rules;
    }
}
