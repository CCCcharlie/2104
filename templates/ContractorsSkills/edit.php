<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContractorsSkill $contractorsSkill
 * @var string[]|\Cake\Collection\CollectionInterface $contractors
 * @var string[]|\Cake\Collection\CollectionInterface $skills
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contractorsSkill->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contractorsSkill->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Contractors Skills'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contractorsSkills form content">
            <?= $this->Form->create($contractorsSkill) ?>
            <fieldset>
                <legend><?= __('Edit Contractors Skill') ?></legend>
                <?php
                    echo $this->Form->control('contractor_id', ['options' => $contractors, 'empty' => true]);
                    echo $this->Form->control('skill_id', ['options' => $skills, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
