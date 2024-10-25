<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContractorsSkill $contractorsSkill
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Contractors Skill'), ['action' => 'edit', $contractorsSkill->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contractors Skill'), ['action' => 'delete', $contractorsSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contractorsSkill->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contractors Skills'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contractors Skill'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contractorsSkills view content">
            <h3><?= h($contractorsSkill->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Contractor') ?></th>
                    <td><?= $contractorsSkill->hasValue('contractor') ? $this->Html->link($contractorsSkill->contractor->id, ['controller' => 'Contractors', 'action' => 'view', $contractorsSkill->contractor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Skill') ?></th>
                    <td><?= $contractorsSkill->hasValue('skill') ? $this->Html->link($contractorsSkill->skill->skill_name, ['controller' => 'Skills', 'action' => 'view', $contractorsSkill->skill->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contractorsSkill->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>