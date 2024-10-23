<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SkillsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('skills');
        $this->setDisplayField('skill_name');
        $this->setPrimaryKey('id');

        // Define the many-to-many association with Projects
        $this->belongsToMany('Projects', [
            'joinTable' => 'projects_skills',
            'foreignKey' => 'skill_id',
            'targetForeignKey' => 'project_id',
        ]);
    }
}

