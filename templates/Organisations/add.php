<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 */
?>
<div class="row">
    <aside class="column">
        <!-- Back to Dashboard button -->
        <div class="back-button">
            <?= $this->Html->link(__('Back'), ['controller' => 'Dashboard', 'action' => 'index'], ['class' => 'button']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organisations form content">
            <?= $this->Form->create($organisation) ?>
            <fieldset>
                <legend><?= __('Add Organisation') ?></legend>
                <?php
                echo $this->Form->control('business_name', ['required' => true]);
                echo $this->Form->control('contact_first_name', ['required' => true]);
                echo $this->Form->control('contact_last_name', ['required' => true]);
                echo $this->Form->control('contact_email', ['required' => true]);
                echo $this->Form->control('current_website', ['required' => true,
                                    'type' => 'url', // Set the type to url to validate URL format
                    'placeholder' => 'https://example.com' // Optional: provide a placeholder for clarity
                ]);
                echo $this->Form->control('industry', ['required' => true]);
                ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
