<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $message
 * @property int|null $organisation_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property int|null $contractors_id
 * @property int|null $replied
 *
 * @property \App\Model\Entity\Organisation $organisation
 * @property \App\Model\Entity\Contractor $contractor
 */
class Contact extends Entity
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
        'id' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'phone_number' => true,
        'message' => true,
        'organisation_id' => true,
        'created' => true,
        'modified' => true,
        'contractors_id' => true,
        'replied' => true,
        'organisation' => true,
        'contractor' => true,
    ];
}
