<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * Configures the table's settings, including the name, display field, and primary key, as well as behaviors.
     *
     * @param array<string, mixed> $config Configuration array for the table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Set the table name
        $this->setTable('users');
        // Define the display field used in lists or labels
        $this->setDisplayField('email');
        // Set the primary key for the table
        $this->setPrimaryKey('id');

        // Automatically manage created and modified timestamps
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * Defines validation rules for user data, such as type, length, and format.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator Returns the validator with rules added.
     */
    public function validationDefault(Validator $validator): Validator
    {
        // Validate first name: must be a string of up to 255 characters, optional field
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        // Validate last name: must be a string of up to 255 characters, optional field
        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        // Validate email: must be a valid email format, optional field
        $validator
            ->email('email')
            ->allowEmptyString('email');

        // Validate password: must be a string of up to 255 characters, optional field
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating application integrity.
     *
     * Ensures unique constraints, such as requiring a unique email for each user.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker Returns the modified rules checker.
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Ensures that each email is unique within the users table
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
