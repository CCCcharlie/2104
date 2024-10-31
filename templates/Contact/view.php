<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <!-- Back to Contractor List -->
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'button', 'style' => 'color: white;']) ?>

            <!-- Edit Contractor -->
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'button', 'style' => 'color: white; background-color: #007bff;']) ?>

            <!-- Delete Contractor -->
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contact->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $contact->id),
                    'class' => 'button',
                    'style' => 'color: white; background-color: #dc3545;'
                ]
            ) ?>
        </div>
    </aside>
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
                    <td><?= $contact->hasValue('organisation') ? $this->Html->link($contact->organisation->business_name, ['controller' => 'Organisations', 'action' => 'view', $contact->organisation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Contractor') ?></th>
                    <td><?= $contact->hasValue('contractor') ? $this->Html->link($contact->contractor->first_name. ' ' . $contact->contractor->last_name, ['controller' => 'Contractors', 'action' => 'view', $contact->contractor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contact->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Replied') ?></th>
                    <td><?= $contact->replied === null ? '' : $this->Number->format($contact->replied) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($contact->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($contact->modified) ?></td>
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
