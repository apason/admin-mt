<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Task'), ['controller' => 'Task', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Task', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="answer form large-9 medium-8 columns content">
    <?= $this->Form->create($answer) ?>
    <fieldset>
        <legend><?= __('Add Answer') ?></legend>
        <?php
            echo $this->Form->input('issued');
            echo $this->Form->input('loaded', ['empty' => true]);
            echo $this->Form->input('enabled');
            echo $this->Form->input('task_id', ['options' => $task, 'empty' => true]);
            echo $this->Form->input('user_id', ['options' => $user, 'empty' => true]);
            echo $this->Form->input('uri');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
