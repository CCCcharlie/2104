<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectsSkill $projectsSkill
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Projects Skill'), ['action' => 'edit', $projectsSkill->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Projects Skill'), ['action' => 'delete', $projectsSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsSkill->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Projects Skills'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Projects Skill'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="projectsSkills view content">
            <h3><?= h($projectsSkill->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project') ?></th>
                    <td><?= $projectsSkill->hasValue('project') ? $this->Html->link($projectsSkill->project->id, ['controller' => 'Projects', 'action' => 'view', $projectsSkill->project->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Skill') ?></th>
                    <td><?= $projectsSkill->hasValue('skill') ? $this->Html->link($projectsSkill->skill->skill_name, ['controller' => 'Skills', 'action' => 'view', $projectsSkill->skill->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectsSkill->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>