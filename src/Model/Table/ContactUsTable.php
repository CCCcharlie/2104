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
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('contact_us');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 10)
            ->allowEmptyString('phone_number');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        $validator
            ->integer('organisation_id')
            ->allowEmptyString('organisation_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['organisation_id'], 'Organisations'), ['errorField' => 'organisation_id']);

        return $rules;
    }
}
