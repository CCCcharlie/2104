<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var string[]|\Cake\Collection\CollectionInterface $organisations
 */
?>
<!-- Back Button -->
<?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'button']) ?>

<!-- Delete Button -->
<?= $this->Form->postLink(
    __('Delete'),
    ['action' => 'delete', $contact->id],
    [
        'confirm' => __('Are you sure you want to delete # {0}?', $contact->id),
        'class' => 'button'
    ]
) ?>

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



