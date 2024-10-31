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
    <?= $this->Form->control('keyword', ['label' => 'Search by Name']) ?>
    <?= $this->Form->control('email', ['label' => 'Search by Email']) ?>
    <fieldset>
        <legend>Filter by Skills</legend>
        <?php foreach ($skillsList as $id => $skillName): ?>
            <?= $this->Form->control("skills[]", [
                'type' => 'checkbox',
                'value' => $id,
                'label' => $skillName,
                'checked' => false, // Adjust if needed to retain checked state after form submission
            ]) ?>
        <?php endforeach; ?>
    </fieldset>



    <?= $this->Form->control('project_count', [
        'type' => 'number',
        'label' => 'Minimum Project Count',
        'value' => $this->request->getQuery('project_count'),
            'min' => 0 // Sets the minimum value to 0

    ]) ?>
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
