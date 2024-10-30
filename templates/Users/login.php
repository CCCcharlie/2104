<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8"> <!-- Wider column for form width -->
            <div class=" o-hidden border-0 my-5">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h4 class="text-gray-900"><?= __('Welcome! Please enter your username and password') ?></h4>
                    </div>
                    <?= $this->Form->create(null, ['class' => 'user']) ?>
                    <fieldset>
                        <div class="form-group mb-4"> <!-- Increased margin for spacing -->
                            <?= $this->Form->control('email', [
                                'class' => 'form-control form-control-user text-center',
                                'placeholder' => 'Enter Email Address...',
                                'label' => false,
                            ]) ?>
                        </div>
                        <div class="form-group mb-4"> <!-- Increased margin for spacing -->
                            <?= $this->Form->control('password', [
                                'class' => 'form-control form-control-user text-center',
                                'placeholder' => 'Password',
                                'label' => false,
                            ]) ?>
                        </div>
                    </fieldset>
                    <?= $this->Form->button(__('Login'), [
                        'class' => 'btn btn-primary btn-user btn-block',
                        'style' => 'padding: 0.75rem 1.5rem;' // Larger button padding
                    ]) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
