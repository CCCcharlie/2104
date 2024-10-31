<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 * @var \Cake\Collection\CollectionInterface|string[] $contractors
 * @var \Cake\Collection\CollectionInterface|string[] $organisations
 * @var \Cake\Collection\CollectionInterface|string[] $skills
 */
?>
<div class="row">
    <aside class="column">
        <!-- Back button -->
        <div class="back-button">
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'button']) ?>
        </div>
        <div class="side-nav">
            <h4 class="heading"><?= __('Add New Project') ?></h4>
        </div>
    </aside>
    <div class="column column-80">
        <div class="projects form content">
            <?= $this->Form->create($project) ?>
            <fieldset>
                <legend><?= __('Add Project') ?></legend>
                <?php
                    echo $this->Form->control('project_name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('management_tool_link');
                    echo $this->Form->control('project_due_date', ['empty' => true]);
                    echo $this->Form->control('last_checked', ['empty' => true]);
                    echo $this->Form->control('complete');
                    echo $this->Form->control('contractor_id', [
                        'options' => $contractors,
                        'empty' => 'Select Contractor',
                        'label' => 'Contractor Name'
                    ]);

                    echo $this->Form->control('organisation_id', [
                        'options' => $organisations,
                        'empty' => 'Select Organisation',
                        'label' => 'Organisation Name'
                    ]);
                    echo $this->Form->control('skills._ids', [
                        'type' => 'select',
                        'multiple' => 'checkbox',
                        'options' => $skills,
                        'label' => 'Select Skills'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
