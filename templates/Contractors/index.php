<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Contractor> $contractors
 */
?>
<div class="contractors index content ">
    <?= $this->Html->link(__('New Contractors'), ['action' => 'add'], ['class' => 'button float-right justify-content-center']) ?>

    <h3><?= __('Contractors') ?></h3>

    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <div class="row mb-2">
        <div class="col-6">
            <?= $this->Form->control('keyword', [
                'label' => 'Search by Name',
                'class' => 'form-control'
            ]) ?>
        </div>
        <div class="col-6">
            <?= $this->Form->control('email', [
                'label' => 'Search by Email',
                'class' => 'form-control'
            ]) ?>
        </div>
    </div>
    <fieldset class="mb-2">
        <legend>Filter by Skills</legend>
        <div class="d-flex flex-wrap gap-1">
            <?php foreach ($skillsList as $id => $skillName): ?>
                <div class="form-check form-check-inline">
                    <?= $this->Form->control("skills[]", [
                        'type' => 'checkbox',
                        'value' => $id,
                        'label' => $skillName,
                        'class' => 'form-check-input',
                        'labelOptions' => ['class' => 'form-check-label mb-0'],
                        'checked' => false
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </fieldset>

    <div class="row mb-2">
        <div class="col-6">
            <?= $this->Form->control('project_count', [
                'type' => 'number',
                'label' => 'Minimum Project Count',
                'value' => $this->request->getQuery('project_count'),
                'class' => 'form-control form-control-sm',
                'min' => 0
            ]) ?>
        </div>
    </div>
<?= $this->Form->button(__('Filter')) ?>
    <?= $this->Form->end() ?>



    <div class="form-group">
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">
            Reset
        </a>
    </div>

    <div class="table-responsive">

        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('phone_number') ?></th>
                    <th><?= $this->Paginator->sort('contractor_email') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contractors as $contractor): ?>
                <tr>
                    <td><?= $this->Number->format($contractor->id) ?></td>
                    <td><?= h($contractor->first_name) ?></td>
                    <td><?= h($contractor->last_name) ?></td>
                    <td><?= h($contractor->phone_number) ?></td>
                    <td><?= h($contractor->contractor_email) ?></td>
                    <td><?= h($contractor->created) ?></td>
                    <td><?= h($contractor->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contractor->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contractor->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contractor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contractor->id)]) ?>
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
