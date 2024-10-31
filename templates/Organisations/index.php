<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Organisation> $organisations
 */
?>
<?= $this->Html->link(__('New Organisations'), ['action' => 'add'], ['class' => 'button float-right justify-content-center']) ?>
<h3><?= __('Organisations') ?></h3>

<?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>
<?= $this->Form->control('keyword', ['label' => 'Search by Organisation Name', 'value' => $this->request->getQuery('keyword')]) ?>
<?= $this->Form->control('sort_by_projects', [
    'type' => 'checkbox',
    'label' => 'Sort by Number of Projects',
    'value' => '1'
]) ?>
<?= $this->Form->create(null, ['type' => 'get']) ?>
<?= $this->Form->control('project_count', [
    'type' => 'number',
    'label' => 'Minimum Project Count',
    'value' => $this->request->getQuery('project_count')
]) ?>
<?= $this->Form->button(__('Filter')) ?>
<?= $this->Form->end() ?>

<div class="form-group">
    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">
        Reset
    </a>
</div>
<div class="organisations index content">

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('business_name') ?></th>
                    <th><?= $this->Paginator->sort('contact_first_name') ?></th>
                    <th><?= $this->Paginator->sort('contact_last_name') ?></th>
                    <th><?= $this->Paginator->sort('contact_email') ?></th>
                    <th><?= $this->Paginator->sort('current_website') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($organisations as $organisation): ?>
                <tr>
                    <td><?= $this->Number->format($organisation->id) ?></td>
                    <td><?= h($organisation->business_name) ?></td>
                    <td><?= h($organisation->contact_first_name) ?></td>
                    <td><?= h($organisation->contact_last_name) ?></td>
                    <td><?= h($organisation->contact_email) ?></td>
                    <td><?= h($organisation->current_website) ?></td>
                    <td><?= h($organisation->created) ?></td>
                    <td><?= h($organisation->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $organisation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $organisation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $organisation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organisation->id)]) ?>
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
