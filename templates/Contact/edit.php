<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var string[]|\Cake\Collection\CollectionInterface $organisations
 * @var string[]|\Cake\Collection\CollectionInterface $contractors
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <!-- Back to contact List -->
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'button', 'style' => 'color: white;']) ?>

            <!-- Delete contact -->
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contact->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $contact->id),
                    'class' => 'button',
                    'style' => 'color: white; background-color: #dc3545;'
                ]

//                custom style for the delete confirmation
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contact form content">
            <?= $this->Form->create($contact) ?>
            <fieldset>
                <legend><?= __('Edit Contact') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone_number');
                    echo $this->Form->control('message');
                    echo $this->Form->control('organisation_id', ['options' => $organisations, 'empty' => true]);
                    echo $this->Form->control('contractors_id', ['options' => $contractors, 'empty' => true]);
                echo $this->Form->control('replied', [
                    'type' => 'select',
                    'options' => [0 => 'Not replied', 1 => 'Replied'],
                    'empty' => 'Not marked'
                ]);
//               make the replied field more understandable
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
