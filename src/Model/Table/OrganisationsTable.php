<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organisations Model
 *
 * @property \App\Model\Table\ContactTable&\Cake\ORM\Association\HasMany $Contact
 * @property \App\Model\Table\ProjectsTable&\Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\Organisation newEmptyEntity()
 * @method \App\Model\Entity\Organisation newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Organisation> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organisation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Organisation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Organisation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Organisation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organisation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Organisation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganisationsTable extends Table
{
    /**
     * Initialize method
     *
     * Configures the Organisations table by defining its properties,
     * behaviors, and associations.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Define the name of the database table this model uses
        $this->setTable('organisations');

        // Set the display field for the model
        $this->setDisplayField('id');

        // Define the primary key field for the model
        $this->setPrimaryKey('id');

        // Add Timestamp behavior to automatically handle created and modified fields
        $this->addBehavior('Timestamp');

        // Define a one-to-many association with the Contact table
        $this->hasMany('Contact', [
            'foreignKey' => 'organisation_id',
        ]);

        // Define a one-to-many association with the Projects table
        $this->hasMany('Projects', [
            'foreignKey' => 'organisation_id',
        ]);
    }

    /**
     * Default validation rules
     *
     * Validates input data for the Organisations table fields.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validate business_name as a string with a max length of 255 characters, allowing it to be empty
        $validator
            ->scalar('business_name')
            ->maxLength('business_name', 255)
            ->allowEmptyString('business_name');

        // Validate contact_first_name as a string with a max length of 255 characters, allowing it to be empty
        $validator
            ->scalar('contact_first_name')
            ->maxLength('contact_first_name', 255)
            ->allowEmptyString('contact_first_name');

        // Validate contact_last_name as a string with a max length of 255 characters, allowing it to be empty
        $validator
            ->scalar('contact_last_name')
            ->maxLength('contact_last_name', 255)
            ->allowEmptyString('contact_last_name');

        // Validate contact_email as a string with a max length of 255 characters, allowing it to be empty
        $validator
            ->scalar('contact_email')
            ->maxLength('contact_email', 255)
            ->allowEmptyString('contact_email');

        // Validate current_website as a string with a max length of 255 characters, allowing it to be empty
        $validator
            ->scalar('current_website')
            ->maxLength('current_website', 255)
            ->allowEmptyString('current_website');

        // Validate industry as a scalar value, allowing it to be empty
        $validator
            ->scalar('industry')
            ->allowEmptyString('industry');

        return $validator;
    }
}
