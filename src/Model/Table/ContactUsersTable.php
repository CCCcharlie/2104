<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactUsers Model
 *
 * @property \App\Model\Table\OrganisationsTable&\Cake\ORM\Association\BelongsTo $Organisations
 *
 * @method \App\Model\Entity\ContactUser newEmptyEntity()
 * @method \App\Model\Entity\ContactUser newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ContactUser> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactUser get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ContactUser findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ContactUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ContactUser> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactUser|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ContactUser saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ContactUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactUser>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactUser> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactUser>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactUser> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactUsersTable extends Table
{
    /**
     * Initialize method
     *
     * Configures the table properties, behaviors, and associations for the ContactUsers model.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Set table name, display field, and primary key for the model
        $this->setTable('contact_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // Add Timestamp behavior to automatically manage created and modified fields
        $this->addBehavior('Timestamp');

        // Define a belongsTo association with the Organisations table
        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
        ]);
    }

    /**
     * Default validation rules
     *
     * Defines validation rules for each field in the 'contact_users' table to ensure data integrity.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validate 'first_name' as a string with a max length of 255 characters
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        // Validate 'last_name' as a string with a max length of 255 characters
        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        // Validate 'email' as a valid email format, allowing it to be empty
        $validator
            ->email('email')
            ->allowEmptyString('email');

        // Validate 'phone_number' as a string with a max length of 10 characters
        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 10)
            ->allowEmptyString('phone_number');

        // Allow 'message' to be a string or empty
        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        // Validate 'organisation_id' as an integer, allowing it to be empty
        $validator
            ->integer('organisation_id')
            ->allowEmptyString('organisation_id');

        return $validator;
    }

    /**
     * Build rules method
     *
     * Defines integrity rules for the table, especially for foreign key constraints.
     * Ensures that the organisation_id exists in the Organisations table.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Ensure that 'organisation_id' exists in the Organisations table
        $rules->add($rules->existsIn(['organisation_id'], 'Organisations'), ['errorField' => 'organisation_id']);

        return $rules;
    }
}
