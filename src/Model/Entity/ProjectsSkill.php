<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProjectsSkill Entity
 *
 * @property int $id
 * @property int $project_id
 * @property int $skill_id
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Skill $skill
 */
class ProjectsSkill extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'project_id' => true,
        'skill_id' => true,
        'project' => true,
        'skill' => true,
    ];
}
