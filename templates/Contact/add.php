<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var \Cake\Collection\CollectionInterface|string[] $organisations
 * @var \Cake\Collection\CollectionInterface|string[] $contractors
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
        <div class="contact form content">
            <?= $this->Form->create($contact) ?>
            <fieldset>
                <legend><?= __('Add Contact') ?></legend>
                <?php
                echo $this->Form->control('first_name', [
                    'required' => true,
                    'label' => 'First Name'
                ]);
                echo $this->Form->control('last_name', [
                    'required' => true,
                    'label' => 'Last Name'
                ]);
                echo $this->Form->control('email', [
                    'required' => true,
                    'label' => 'Email'
                ]);
                echo $this->Form->control('phone_number', [
                    'required' => true,
                    'label' => 'Phone Number'
                ]);
                echo $this->Form->control('message', [
                    'required' => true,
                    'label' => 'Message'
                ]);
                echo $this->Form->control('organisation_id', [
                    'options' => $organisations,
                    'empty' => true,
                    'label' => 'Organisation(Optional)'
                ]);
                echo $this->Form->control('contractors_id', [
                    'options' => $contractors,
                    'empty' => true,
                    'label' => 'Contractor(Optional)'
                ]);

//                    echo $this->Form->control('replied', [
//                        'type' => 'checkbox',
//                        'label' => 'Replied'
//                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
