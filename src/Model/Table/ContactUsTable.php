<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactUs Model
 *
 * @property \App\Model\Table\OrganisationsTable&\Cake\ORM\Association\BelongsTo $Organisations
 *
 * @method \App\Model\Entity\ContactU newEmptyEntity()
 * @method \App\Model\Entity\ContactU newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ContactU> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactU get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ContactU findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ContactU patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ContactU> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactU|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ContactU saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ContactU>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactU>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactU>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactU> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactU>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactU>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactU>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactU> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactUsTable extends Table
{
    /**
     * Initialize method
     *
     * Configures the table name, primary key, behaviors, and associations for the ContactUs model.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Set the name of the database table
        $this->setTable('contact_us');

        // Define the display field and primary key for the model
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // Add Timestamp behavior to automatically handle created and modified fields
        $this->addBehavior('Timestamp');

        // Define the relationship between ContactUs and Organisations tables
        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
        ]);
    }

    /**
     * Default validation rules
     *
     * Specifies validation rules for data integrity and consistency in the 'contact_us' table.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validate first name as a string with a max length of 255 characters
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        // Validate last name as a string with a max length of 255 characters
        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        // Validate email as a correctly formatted email address, allowing it to be empty
        $validator
            ->email('email')
            ->allowEmptyString('email');

        // Validate phone number as a string with a maximum length of 10 characters
        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 10)
            ->allowEmptyString('phone_number');

        // Validate message as a scalar value (string or empty)
        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        // Validate organisation ID as an integer, allowing it to be empty
        $validator
            ->integer('organisation_id')
            ->allowEmptyString('organisation_id');

        return $validator;
    }

    /**
     * Build rules method
     *
     * Defines integrity rules to ensure foreign key constraints. Checks that
     * organisation_id exists in the Organisations table before saving.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Add a rule to ensure organisation_id exists in Organisations table
        $rules->add($rules->existsIn(['organisation_id'], 'Organisations'), ['errorField' => 'organisation_id']);

        return $rules;
    }
}
