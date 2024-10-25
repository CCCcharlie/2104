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
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('projects_skills');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'joinType' => 'INNER',
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
            ->integer('project_id')
            ->notEmptyString('project_id');

        $validator
            ->integer('skill_id')
            ->notEmptyString('skill_id');

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
        $rules->add($rules->existsIn(['project_id'], 'Projects'), ['errorField' => 'project_id']);
        $rules->add($rules->existsIn(['skill_id'], 'Skills'), ['errorField' => 'skill_id']);

        return $rules;
    }
}
