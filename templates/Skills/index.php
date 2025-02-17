<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Skill> $skills
 */
?>
<div class="skills index content">
    <?= $this->Html->link(__('New Skill'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Skills') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('skill_name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($skills as $skill): ?>
                <tr>
                    <td><?= $this->Number->format($skill->id) ?></td>
                    <td><?= h($skill->skill_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $skill->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $skill->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $skill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $skill->id)]) ?>
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
