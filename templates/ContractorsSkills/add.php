<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContractorsSkill $contractorsSkill
 * @var \Cake\Collection\CollectionInterface|string[] $contractors
 * @var \Cake\Collection\CollectionInterface|string[] $skills
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contractors Skills'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contractorsSkills form content">
            <?= $this->Form->create($contractorsSkill) ?>
            <fieldset>
                <legend><?= __('Add Contractors Skill') ?></legend>
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
