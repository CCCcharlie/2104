<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contractors Model
 *
 * @property \App\Model\Table\ProjectsTable&\Cake\ORM\Association\HasMany $Projects
 * @property \App\Model\Table\SkillsTable&\Cake\ORM\Association\BelongsToMany $Skills
 *
 * @method \App\Model\Entity\Contractor newEmptyEntity()
 * @method \App\Model\Entity\Contractor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Contractor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contractor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Contractor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Contractor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Contractor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contractor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Contractor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Contractor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contractor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contractor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contractor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contractor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contractor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contractor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contractor> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContractorsTable extends Table
{
    /**
     * Initialize method
     *
     * Sets up the model's configuration, table name, display field, primary key,
     * behaviors, and associations with Projects and Skills.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Define the database table used by this model
        $this->setTable('contractors');

        // Define the display field for the model
        $this->setDisplayField('id');

        // Define the primary key for the model
        $this->setPrimaryKey('id');

        // Add Timestamp behavior to automatically manage created and modified fields
        $this->addBehavior('Timestamp');

        // Set up a hasMany association with Projects table
        $this->hasMany('Projects', [
            'foreignKey' => 'contractor_id',
        ]);

        // Set up a belongsToMany association with Skills table through contractors_skills table
        $this->belongsToMany('Skills', [
            'joinTable' => 'contractors_skills',
            'foreignKey' => 'contractor_id',
            'targetForeignKey' => 'skill_id',
        ]);
    }

    /**
     * Default validation rules
     *
     * Defines validation rules to ensure data integrity for contractor fields.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validate first_name as a string up to 255 characters, allowing it to be empty
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        // Validate last_name as a string up to 255 characters, allowing it to be empty
        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        // Validate phone_number as a string up to 10 characters, allowing it to be empty
        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 10)
            ->allowEmptyString('phone_number');

        // Validate contractor_email as a string up to 255 characters, allowing it to be empty
        $validator
            ->scalar('contractor_email')
            ->maxLength('contractor_email', 255)
            ->allowEmptyString('contractor_email');

        return $validator;
    }
}
