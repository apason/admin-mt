<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Task'), ['controller' => 'Task', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Task', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="answer index large-9 medium-8 columns content">
    <h3><?= __('Answer') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('issued') ?></th>
                <th><?= $this->Paginator->sort('loaded') ?></th>
                <th><?= $this->Paginator->sort('enabled') ?></th>
                <th><?= $this->Paginator->sort('task_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('uri') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($answer as $answer): ?>
            <tr>
                <td><?= $this->Number->format($answer->id) ?></td>
                <td><?= h($answer->issued) ?></td>
                <td><?= h($answer->loaded) ?></td>
                <td><?= h($answer->enabled) ?></td>
                <td><?= $answer->has('task') ? $this->Html->link($answer->task->id, ['controller' => 'Task', 'action' => 'view', $answer->task->id]) : '' ?></td>
                <td><?= $answer->has('user') ? $this->Html->link($answer->user->id, ['controller' => 'User', 'action' => 'view', $answer->user->id]) : '' ?></td>
                <td><?= h($answer->uri) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $answer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $answer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
