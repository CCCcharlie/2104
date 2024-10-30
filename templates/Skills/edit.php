<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Skill $skill
 * @var string[]|\Cake\Collection\CollectionInterface $projects
 */
?>
<div class="row">
    <aside class="column">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <!-- Back button -->
        <div class="back-button">
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'button']) ?>
        </div>
        <div class="side-nav">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $skill->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $skill->id), 'class' => 'side-nav-item',
                    'class' => 'button',
                    'style' => 'color: white; background-color: #dc3545;']
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="skills form content">
            <?= $this->Form->create($skill) ?>
            <fieldset>
                <legend><?= __('Edit Skill') ?></legend>
                <?php
                    echo $this->Form->control('skill_name');
                    echo $this->Form->control('projects._ids', ['options' => $projects]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
