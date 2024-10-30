<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 * @var string[]|\Cake\Collection\CollectionInterface $contractors
 * @var string[]|\Cake\Collection\CollectionInterface $organisations
 * @var string[]|\Cake\Collection\CollectionInterface $skills
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <!-- Back to Projects List -->
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'button', 'style' => 'color: white; background-color: #007bff;']) ?>

            <!-- Delete Project -->
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $project->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $project->id),
                    'class' => 'button',
                    'style' => 'color: white; background-color: #dc3545;'
                ]
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="projects form content">
            <?= $this->Form->create($project) ?>
            <fieldset>
                <legend><?= __('Edit Project') ?></legend>
                <?php
                    echo $this->Form->control('project_name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('management_tool_link');
                    echo $this->Form->control('project_due_date', ['empty' => true]);
                    echo $this->Form->control('last_checked', ['empty' => true]);
                    echo $this->Form->control('complete');
                    echo $this->Form->control('contractor_id', ['options' => $contractors, 'empty' => true]);
                    echo $this->Form->control('organisation_id', ['options' => $organisations, 'empty' => true]);
                    echo $this->Form->control('skills._ids', ['options' => $skills]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
