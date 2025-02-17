<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <!-- Back to Organisation List -->
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'button', 'style' => 'color: white']) ?>

            <!-- Delete Organisation -->
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $organisation->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $organisation->id),
                    'class' => 'button',
                    'style' => 'color: white; background-color: #dc3545;'
                ]
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organisations form content">
            <?= $this->Form->create($organisation) ?>
            <fieldset>
                <legend><?= __('Edit Organisation') ?></legend>
                <?php
                    echo $this->Form->control('business_name');
                    echo $this->Form->control('contact_first_name');
                    echo $this->Form->control('contact_last_name');
                    echo $this->Form->control('contact_email');
                    echo $this->Form->control('current_website');
                    echo $this->Form->control('industry');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
