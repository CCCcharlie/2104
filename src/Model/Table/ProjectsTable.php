<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property \App\Model\Table\ContractorsTable&\Cake\ORM\Association\BelongsTo $Contractors
 * @property \App\Model\Table\OrganisationsTable&\Cake\ORM\Association\BelongsTo $Organisations
 * @property \App\Model\Table\SkillsTable&\Cake\ORM\Association\BelongsToMany $Skills
 *
 * @method \App\Model\Entity\Project newEmptyEntity()
 * @method \App\Model\Entity\Project newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Project> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Project findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Project> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Project saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Project>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Project>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Project>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Project> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Project>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Project>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Project>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Project> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
{
    /**
     * Initialize method
     *
     * Configures the Projects table, setting up behaviors and associations.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Define the name of the table in the database
        $this->setTable('projects');

        // Set the field used to display records in views
        $this->setDisplayField('id');

        // Set the primary key for this table
        $this->setPrimaryKey('id');

        // Adds the Timestamp behavior to automatically handle created and modified timestamps
        $this->addBehavior('Timestamp');

        // Set up the association with the Contractors table (many-to-one)
        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractor_id',
        ]);

        // Set up the association with the Organisations table (many-to-one)
        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
        ]);

        // Set up the association with the Skills table (many-to-many through projects_skills)
        $this->belongsToMany('Skills', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'skill_id',
            'joinTable' => 'projects_skills', // Specifies the join table for the many-to-many relationship
        ]);
    }

    /**
     * Default validation rules
     *
     * Specifies validation rules for the Projects table fields.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validates project_name as a string up to 255 characters
        $validator
            ->scalar('project_name')
            ->maxLength('project_name', 255)
            ->allowEmptyString('project_name');

        // Allows an optional description for the project
        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        // Validates management_tool_link as a string up to 255 characters
        $validator
            ->scalar('management_tool_link')
            ->maxLength('management_tool_link', 255)
            ->allowEmptyString('management_tool_link');

        // Validates project_due_date as a datetime field
        $validator
            ->dateTime('project_due_date')
            ->allowEmptyDateTime('project_due_date');

        // Validates last_checked as a datetime field
        $validator
            ->dateTime('last_checked')
            ->allowEmptyDateTime('last_checked');

        // Validates complete as a boolean field
        $validator
            ->boolean('complete')
            ->allowEmptyString('complete');

        // Validates contractor_id as an integer
        $validator
            ->integer('contractor_id')
            ->allowEmptyString('contractor_id');

        // Validates organisation_id as an integer
        $validator
            ->integer('organisation_id')
            ->allowEmptyString('organisation_id');

        return $validator;
    }

    /**
     * Returns a rules checker object for validating application integrity
     *
     * Ensures that contractor_id and organisation_id reference valid records in their respective tables.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Ensures that contractor_id references a valid Contractor record
        $rules->add($rules->existsIn(['contractor_id'], 'Contractors'), ['errorField' => 'contractor_id']);

        // Ensures that organisation_id references a valid Organisation record
        $rules->add($rules->existsIn(['organisation_id'], 'Organisations'), ['errorField' => 'organisation_id']);

        return $rules;
    }
}
