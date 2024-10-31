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
            <?= $this->Html->link(__('Back'), ['controller' => 'Dashboard', 'action' => 'index'], ['class' => 'button']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contractors form content">
            <?= $this->Form->create($contractor) ?>
            <fieldset>
                <legend><?= __('Add Contractor') ?></legend>
                <?php
                echo $this->Form->control('first_name', [
                    'required' => true,
                    'label' => 'First Name'
                ]);
                echo $this->Form->control('last_name', [
                    'required' => true,
                    'label' => 'Last Name'
                ]);
                echo $this->Form->control('phone_number', [
                    'required' => true,
                    'label' => 'Phone Number'
                ]);
                echo $this->Form->control('contractor_email', [
                    'required' => true, // ensure being filled
                    'label' => 'Contractor Email'
                ]);
                echo $this->Form->control('skills._ids', [
                    'type' => 'select',
                    'multiple' => true, // Ensure multiple selections
                    'options' => $skills,
                    'label' => 'Select Skills',
                    'required' => true // Ensure at least one skill is selected
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
