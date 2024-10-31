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
<?= $this->Form->control('start_date', ['type' => 'date', 'label' => 'Start Date', 'value' => $this->request->getQuery('start_date')]) ?>
<?= $this->Form->control('end_date', ['type' => 'date', 'label' => 'End Date', 'value' => $this->request->getQuery('end_date')]) ?>
<?= $this->Form->button(__('Filter')) ?>
<?= $this->Form->end() ?>

<!-- Reset Button -->
<div class="form-group">
    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Reset</a>
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
                    <td><?= h($project->complete ? __('complete') : __('incomplete')); ?></td>

                    <td><?= $project->hasValue('contractor') ? $this->Html->link(       $project->contractor->first_name . " " . $project->contractor->last_name, ['controller' => 'Contractors', 'action' => 'view', $project->contractor->id]) : 'Not assigned'  ?></td>
                    <td><?= $project->hasValue('organisation') ? $this->Html->link($project->organisation->business_name, ['controller' => 'Organisations', 'action' => 'view', $project->organisation->id]) : 'Not assigned' ?></td>
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
