<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Organisation> $organisations
 */
?>
<?= $this->Html->link(__('New Organisations'), ['action' => 'add'], ['class' => 'button float-right justify-content-center']) ?>
<h3><?= __('Organisations') ?></h3>


<?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>

<div class="row mb-2">
    <div class="col-md-6">
        <?= $this->Form->control('keyword', [
            'label' => 'Search by Organisation Name',
            'value' => $this->request->getQuery('keyword'),
            'class' => 'form-control'
        ]) ?>
    </div>
    <div class="col-md-6">

        <?= $this->Form->control('project_count', [
            'type' => 'number',
            'label' => 'Minimum Project Count',
            'value' => $this->request->getQuery('project_count'),
            'min' => '0',
            'class' => 'form-control'
        ]) ?>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-6">

        <?= $this->Form->control('sort_by_projects', [
            'type' => 'checkbox',
            'label' => 'Sort by Number of Projects',
            'value' => '1',
        ]) ?>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 d-flex justify-content-center">
        <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-primary h-75 mr-3']) ?>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary h-75 ml-3">Reset</a>
    </div>
</div>

<?= $this->Form->end() ?>

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
    <div class="paginator my-3"> <!-- Add vertical margin to the whole paginator -->
        <ul class="pagination justify-content-center"> <!-- Center the pagination -->
            <li class="page-item mx-1"><?= $this->Paginator->first('<< ' . __('first')) ?></li>
            <li class="page-item mx-1"><?= $this->Paginator->prev('< ' . __('previous')) ?></li>
            <li class="page-item mx-1"><?= $this->Paginator->numbers() ?></li>
            <li class="page-item mx-1"><?= $this->Paginator->next(__('next') . ' >') ?></li>
            <li class="page-item mx-1"><?= $this->Paginator->last(__('last') . ' >>') ?></li>
        </ul>
        <p class="text-center mt-3"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
