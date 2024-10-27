<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var \Cake\Collection\CollectionInterface|string[] $organisations
 */
?>

<div class="row">
    <aside class="column">
        <!-- Back button -->
        <div class="back-button">
            <?= $this->Html->link(__('Back to Contacts'), ['action' => 'index'], ['class' => 'button']) ?>
        </div>
        <div class="side-nav">
            <h4 class="heading"><?= __('Add new contact') ?></h4>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contact form content">
            <?= $this->Form->create($contact) ?>
            <fieldset>
                <legend><?= __('Add Contact') ?></legend>
                <?php
                echo $this->Form->control('first_name');
                echo $this->Form->control('last_name');
                echo $this->Form->control('email');
                echo $this->Form->control('phone_number');
                echo $this->Form->control('message');
                echo $this->Form->control('organisation_id', ['options' => $organisations, 'empty' => true]);
                echo $this->Form->control('contractor_id');
                echo $this->Form->control('replied');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
