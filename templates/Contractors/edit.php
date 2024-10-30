<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contractor $contractor
 * @var string[]|\Cake\Collection\CollectionInterface $skills
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <!-- Back to Contractor List -->
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'button', 'style' => 'color: white; background-color: #007bff;']) ?>

            <!-- Delete Contractor -->
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contractor->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $contractor->id),
                    'class' => 'button',
                    'style' => 'color: white; background-color: #dc3545;'
                ]
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contractors form content">
            <?= $this->Form->create($contractor) ?>
            <fieldset>
                <legend><?= __('Edit Contractor') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('phone_number');
                    echo $this->Form->control('contractor_email');
                    echo $this->Form->control('skills._ids', ['options' => $skills]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
