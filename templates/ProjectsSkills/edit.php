<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectsSkill $projectsSkill
 * @var string[]|\Cake\Collection\CollectionInterface $projects
 * @var string[]|\Cake\Collection\CollectionInterface $skills
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $projectsSkill->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectsSkill->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Projects Skills'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="projectsSkills form content">
            <?= $this->Form->create($projectsSkill) ?>
            <fieldset>
                <legend><?= __('Edit Projects Skill') ?></legend>
                <?php
                    echo $this->Form->control('project_id', ['options' => $projects]);
                    echo $this->Form->control('skill_id', ['options' => $skills]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
