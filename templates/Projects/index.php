<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Project> $projects
 */
?>
<?= $this->Html->link(__('New Project'), ['action' => 'add'], ['class' => 'button float-right']) ?>

<h3><?= __('Projects') ?></h3>

<?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>
<?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>

<div class="row mb-2">
    <div class="col-md-6"> <!--  col-md-6 to make sure they take half screen each  -->
        <?= $this->Form->control('keyword', [
            'label' => 'Search by Skill Keyword',
            'value' => $this->request->getQuery('keyword')
        ]) ?>
    </div>
    <div class="col-md-6"> <!--  col-md-6 -->
        <?= $this->Form->control('status', [
            'type' => 'select',
            'options' => ['1' => 'Complete', '0' => 'Incomplete'],
            'label' => 'Filter by Status',
            'empty' => 'Select Status',
            'value' => $this->request->getQuery('status')
        ]) ?>
    </div>
</div>

<fieldset class="mb-2">
    <legend>Filter by Skills</legend>
    <div class="d-flex flex-wrap gap-1"> <!--  column-6 -->
        <?php foreach ($skillsList as $id => $skillName): ?>
            <div class="form-check form-check-inline">
                <?= $this->Form->control("skills[]", [
                    'type' => 'checkbox',
                    'value' => $id,
                    'label' => $skillName,
                    'class' => 'form-check-input',
                    'labelOptions' => ['class' => 'form-check-label'],
                    'checked' => false
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</fieldset>

<div class="row mb-2">
    <div class="col-md-6">
        <?= $this->Form->control('start_date', [
            'type' => 'date',
            'label' => 'Start Date',
            'value' => $this->request->getQuery('start_date'),
            'class' => 'form-control'
        ]) ?>
    </div>
    <div class="col-md-6"> <!-- fixed these -->
        <?= $this->Form->control('end_date', [
            'type' => 'date',
            'label' => 'End Date',
            'value' => $this->request->getQuery('end_date'),
            'class' => 'form-control'
        ]) ?>
    </div>
</div>

<div class="d-flex justify-content-between gap-2">
    <?= $this->Form->button(__('Filter')) ?>
    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Reset</a>
</div>

<?= $this->Form->end() ?>


<div class="projects index content">
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
