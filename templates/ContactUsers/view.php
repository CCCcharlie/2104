<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactUser $contactUser
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Contact User'), ['action' => 'edit', $contactUser->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contact User'), ['action' => 'delete', $contactUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactUser->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contact Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contact User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contactUsers view content">
            <h3><?= h($contactUser->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($contactUser->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($contactUser->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($contactUser->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone Number') ?></th>
                    <td><?= h($contactUser->phone_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Organisation') ?></th>
                    <td><?= $contactUser->hasValue('organisation') ? $this->Html->link($contactUser->organisation->id, ['controller' => 'Organisations', 'action' => 'view', $contactUser->organisation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contactUser->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($contactUser->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($contactUser->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Message') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contactUser->message)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>