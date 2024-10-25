<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Project> $projects
 */
?>
<?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>
<?= $this->Form->control('keyword', ['label' => 'Search by Skill Keyword', 'value' => $this->request->getQuery('keyword')]) ?>
<?= $this->Form->control('status', [
    'type' => 'select',
    'options' => ['1' => 'Complete', '0' => 'Incomplete'],
    'label' => 'Filter by Status',
    'empty' => 'Select Status',
    'value' => $this->request->getQuery('status')
]) ?>

<?=

$this->Form->control('skills', [
    'type' => 'select',
    'multiple' => true,
    'options' => $skillList,
    'label' => 'Filter by Skills'
]) ?>
<?= $this->Form->control('start_date', ['type' => 'date', 'label' => 'Start Date', 'value' => $this->request->getQuery('start_date')]) ?>
<?= $this->Form->control('end_date', ['type' => 'date', 'label' => 'End Date', 'value' => $this->request->getQuery('end_date')]) ?>
<?= $this->Form->button(__('Filter')) ?>
<?= $this->Form->end() ?>

<!-- Create the form for filtering and searching -->
<?= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']) ?>


<!-- Reset Button (to reset the filters) -->
<div class="form-group">
    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">
        Reset
    </a>
</div>

<?= $this->Form->end() ?>

<div class="projects index content">
    <?= $this->Html->link(__('New Project'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Projects') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_name') ?></th>
                    <th><?= $this->Paginator->sort('management_tool_link') ?></th>
                    <th><?= $this->Paginator->sort('project_due_date') ?></th>
                    <th><?= $this->Paginator->sort('last_checked') ?></th>
                    <th><?= $this->Paginator->sort('complete') ?></th>
                    <th><?= $this->Paginator->sort('contractor_id') ?></th>
                    <th><?= $this->Paginator->sort('organisation_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= $this->Number->format($project->id) ?></td>
                    <td><?= h($project->project_name) ?></td>
                    <td><?= h($project->management_tool_link) ?></td>
                    <td><?= h($project->project_due_date) ?></td>
                    <td><?= h($project->last_checked) ?></td>
                    <td><?= h($project->complete) ?></td>
                    <td><?= $project->hasValue('contractor') ? $this->Html->link($project->contractor->id, ['controller' => 'Contractors', 'action' => 'view', $project->contractor->id]) : '' ?></td>
                    <td><?= $project->hasValue('organisation') ? $this->Html->link($project->organisation->id, ['controller' => 'Organisations', 'action' => 'view', $project->organisation->id]) : '' ?></td>
                    <td><?= h($project->created) ?></td>
                    <td><?= h($project->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $project->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
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
