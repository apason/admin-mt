<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading">Toiminnot</li>
        <li><?= $this->Html->link('Uusi tehtävä', ['action' => 'add']) ?></li>
        <li><?= $this->Html->link('Listaa kategoriat', ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link('Uusi kategoria', ['controller' => 'Category', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link('Listaa vastaukset', ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link('Uusi vastaus', ['controller' => 'Answer', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="task index large-9 medium-8 columns content">
    <h3><?= __('Task') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('category_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('uploaded') ?></th>
                <th><?= $this->Paginator->sort('enabled') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('info') ?></th>
                <th><?= $this->Paginator->sort('uri') ?></th>
                <th><?= $this->Paginator->sort('icon_uri') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($task as $task): ?>
            <tr>
                <td><?= $this->Number->format($task->id) ?></td>
                <td><?= $task->has('category') ? $this->Html->link($task->category->name, ['controller' => 'Category', 'action' => 'view', $task->category->id]) : '' ?></td>
                <td><?= h($task->created) ?></td>
                <td><?= h($task->uploaded) ?></td>
                <td><?= h($task->enabled) ?></td>
                <td><?= h($task->name) ?></td>
                <td><?= h($task->info) ?></td>
                <td><?= h($task->uri) ?></td>
                <td><?= h($task->icon_uri) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $task->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $task->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?>
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
