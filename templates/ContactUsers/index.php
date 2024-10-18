<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ContactUser> $contactUsers
 */
?>
<div class="contactUsers index content">
    <?= $this->Html->link(__('New Contact User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contact Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone_number') ?></th>
                    <th><?= $this->Paginator->sort('organisation_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactUsers as $contactUser): ?>
                <tr>
                    <td><?= $this->Number->format($contactUser->id) ?></td>
                    <td><?= h($contactUser->first_name) ?></td>
                    <td><?= h($contactUser->last_name) ?></td>
                    <td><?= h($contactUser->email) ?></td>
                    <td><?= h($contactUser->phone_number) ?></td>
                    <td><?= $contactUser->hasValue('organisation') ? $this->Html->link($contactUser->organisation->id, ['controller' => 'Organisations', 'action' => 'view', $contactUser->organisation->id]) : '' ?></td>
                    <td><?= h($contactUser->created) ?></td>
                    <td><?= h($contactUser->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contactUser->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactUser->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactUser->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>