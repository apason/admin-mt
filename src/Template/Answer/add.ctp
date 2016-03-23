<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Task'), ['controller' => 'Task', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Task', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?></li>
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
            echo $this->Form->input('task_id', ['options' => $task]);
            echo $this->Form->input('subuser_id', ['options' => $subuser]);
            echo $this->Form->input('uri');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
