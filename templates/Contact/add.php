<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var \Cake\Collection\CollectionInterface|string[] $organisations
 */
?>
<?= $this->Form->create($contact) ?>
<?= $this->Form->control('first_name', ['label' => 'First Name']) ?>
<?= $this->Form->control('last_name', ['label' => 'Last Name']) ?>
<?= $this->Form->control('email', ['label' => 'Email']) ?>
<?= $this->Form->control('phone_number', ['label' => 'Phone Number']) ?>
<?= $this->Form->control('message', ['type' => 'textarea', 'label' => 'Message']) ?>

<?= $this->Form->control('organisation_id', [
    'type' => 'select',
    'options' => $organisations,
    'empty' => 'Select Organisation (Optional)',
    'label' => 'Organisation'
]) ?>

<?= $this->Form->control('contractor_id', [
    'type' => 'select',
    'options' => $contractors,
    'empty' => 'Select Contractor (Optional)',
    'label' => 'Contractor'
]) ?>

<?= $this->Form->control('replied', [
    'type' => 'checkbox',
    'label' => 'Mark as Replied'
]) ?>

<?= $this->Form->button(__('Save Contact')) ?>
<?= $this->Form->end() ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contact'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
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
