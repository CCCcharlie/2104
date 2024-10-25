<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ProjectsSkill> $projectsSkills
 */
?>
<div class="projectsSkills index content">
    <?= $this->Html->link(__('New Projects Skill'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Projects Skills') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_id') ?></th>
                    <th><?= $this->Paginator->sort('skill_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectsSkills as $projectsSkill): ?>
                <tr>
                    <td><?= $this->Number->format($projectsSkill->id) ?></td>
                    <td><?= $projectsSkill->hasValue('project') ? $this->Html->link($projectsSkill->project->id, ['controller' => 'Projects', 'action' => 'view', $projectsSkill->project->id]) : '' ?></td>
                    <td><?= $projectsSkill->hasValue('skill') ? $this->Html->link($projectsSkill->skill->skill_name, ['controller' => 'Skills', 'action' => 'view', $projectsSkill->skill->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectsSkill->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectsSkill->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectsSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsSkill->id)]) ?>
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