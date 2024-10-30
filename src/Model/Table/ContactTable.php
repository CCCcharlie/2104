<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contact Model
 *
 * @property \App\Model\Table\OrganisationsTable&\Cake\ORM\Association\BelongsTo $Organisations
 * @property \App\Model\Table\ContractorsTable&\Cake\ORM\Association\BelongsTo $Contractors
 *
 * @method \App\Model\Entity\Contact newEmptyEntity()
 * @method \App\Model\Entity\Contact newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Contact> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contact get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Contact findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Contact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Contact> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contact|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Contact saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactTable extends Table
{
    /**
     * Initialize method
     *
     * Configures the table properties, behaviors, and associations.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Set the table name, display field, and primary key field
        $this->setTable('contact');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // Add the Timestamp behavior to automatically manage created and modified fields
        $this->addBehavior('Timestamp');

        // Define the belongsTo association with Organisations
        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
        ]);

        // Define the belongsTo association with Contractors
        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractors_id',
        ]);
    }

    /**
     * Default validation rules
     *
     * Specifies validation rules for the fields in the 'contact' table to ensure data integrity.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validate 'id' as an integer, allowing it to be empty
        $validator
            ->integer('id')
            ->allowEmptyString('id');

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

        // Validate 'email' as a valid email format
        $validator
            ->email('email')
            ->allowEmptyString('email');

        // Validate 'phone_number' as a string with a max length of 10 characters
        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 10)
            ->allowEmptyString('phone_number');

        // Allow 'message' to be any string or empty
        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        // Validate 'organisation_id' as an integer, allowing it to be empty
        $validator
            ->integer('organisation_id')
            ->allowEmptyString('organisation_id');

        // Validate 'contractors_id' as an integer, allowing it to be empty
        $validator
            ->integer('contractors_id')
            ->allowEmptyString('contractors_id');

        // Validate 'replied' as an integer, allowing it to be empty
        $validator
            ->integer('replied')
            ->allowEmptyString('replied');

        return $validator;
    }

    /**
     * Build rules method
     *
     * Defines application rules to ensure data integrity, especially for foreign key relationships.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Ensure that 'organisation_id' exists in the Organisations table
        $rules->add($rules->existsIn(['organisation_id'], 'Organisations'), ['errorField' => 'organisation_id']);

        // Ensure that 'contractors_id' exists in the Contractors table
        $rules->add($rules->existsIn(['contractors_id'], 'Contractors'), ['errorField' => 'contractors_id']);

        return $rules;
    }
}
