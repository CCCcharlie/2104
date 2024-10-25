<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContractorsSkill Entity
 *
 * @property int $id
 * @property int|null $contractor_id
 * @property int|null $skill_id
 *
 * @property \App\Model\Entity\Contractor $contractor
 * @property \App\Model\Entity\Skill $skill
 */
class ContractorsSkill extends Entity
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
        'contractor_id' => true,
        'skill_id' => true,
        'contractor' => true,
        'skill' => true,
    ];
}
