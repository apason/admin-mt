<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Task'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="task view large-9 medium-8 columns content">
    <h3><?= h($task->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Uri') ?></th>
            <td><?= h($task->uri) ?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= $task->has('category') ? $this->Html->link($task->category->name, ['controller' => 'Category', 'action' => 'view', $task->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($task->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Loaded') ?></th>
            <td><?= h($task->loaded) ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $task->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Answer') ?></h4>
        <?php if (!empty($task->answer)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Issued') ?></th>
                <th><?= __('Loaded') ?></th>
                <th><?= __('Enabled') ?></th>
                <th><?= __('Task Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Uri') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($task->answer as $answer): ?>
            <tr>
                <td><?= h($answer->id) ?></td>
                <td><?= h($answer->issued) ?></td>
                <td><?= h($answer->loaded) ?></td>
                <td><?= h($answer->enabled) ?></td>
                <td><?= h($answer->task_id) ?></td>
                <td><?= h($answer->user_id) ?></td>
                <td><?= h($answer->uri) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Answer', 'action' => 'view', $answer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Answer', 'action' => 'edit', $answer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Answer', 'action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
