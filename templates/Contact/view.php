<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>
<!-- Back Button -->
<?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'button']) ?>

<!-- Edit Button -->
<?= $this->Html->link('Edit', ['action' => 'edit', $contact->id], ['class' => 'button']) ?>
<div class="row">
    <div class="column column-80">
        <div class="contact view content">
            <h3><?= h($contact->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($contact->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($contact->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($contact->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone Number') ?></th>
                    <td><?= h($contact->phone_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Organisation') ?></th>
                    <td><?= $contact->hasValue('organisation') ? $this->Html->link($contact->organisation->id, ['controller' => 'Organisations', 'action' => 'view', $contact->organisation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contact->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contractor Id') ?></th>
                    <td><?= $contact->contractor_id === null ? '' : $this->Number->format($contact->contractor_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($contact->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($contact->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Replied') ?></th>
                    <td><?= $contact->replied ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Message') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contact->message)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
