<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ContractorsSkill> $contractorsSkills
 */
?>
<div class="contractorsSkills index content">
    <?= $this->Html->link(__('New Contractors Skill'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contractors Skills') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('contractor_id') ?></th>
                    <th><?= $this->Paginator->sort('skill_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contractorsSkills as $contractorsSkill): ?>
                <tr>
                    <td><?= $this->Number->format($contractorsSkill->id) ?></td>
                    <td><?= $contractorsSkill->hasValue('contractor') ? $this->Html->link($contractorsSkill->contractor->id, ['controller' => 'Contractors', 'action' => 'view', $contractorsSkill->contractor->id]) : '' ?></td>
                    <td><?= $contractorsSkill->hasValue('skill') ? $this->Html->link($contractorsSkill->skill->skill_name, ['controller' => 'Skills', 'action' => 'view', $contractorsSkill->skill->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contractorsSkill->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contractorsSkill->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contractorsSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contractorsSkill->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>