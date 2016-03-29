<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Answer'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Task'), ['controller' => 'Task', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Task', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="answer view large-9 medium-8 columns content">
    <h3><?= h($answer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Task') ?></th>
            <td><?= $answer->has('task') ? $this->Html->link($answer->task->id, ['controller' => 'Task', 'action' => 'view', $answer->task->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Subuser') ?></th>
            <td><?= $answer->has('subuser') ? $this->Html->link($answer->subuser->id, ['controller' => 'Subuser', 'action' => 'view', $answer->subuser->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Uri') ?></th>
            <td><?= h($answer->uri) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($answer->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Issued') ?></th>
            <td><?= h($answer->issued) ?></td>
        </tr>
        <tr>
            <th><?= __('Loaded') ?></th>
            <td><?= h($answer->loaded) ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $answer->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
