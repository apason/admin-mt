<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="user form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('enabled');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('pin');
            echo $this->Form->input('privacy_level');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
