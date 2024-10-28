<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contractor $contractor
 * @var \Cake\Collection\CollectionInterface|string[] $skills
 */
?>
<div class="row">
    <aside class="column">
        <!-- Back to Dashboard button -->
        <div class="back-button">
            <?= $this->Html->link(__('Back'), ['controller' => 'Dashboard', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contractors form content">
            <?= $this->Form->create($contractor) ?>
            <fieldset>
                <legend><?= __('Add Contractor') ?></legend>
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
