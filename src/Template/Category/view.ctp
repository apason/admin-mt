<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Category'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Task'), ['controller' => 'Task', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Task', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="category view large-9 medium-8 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Bg Uri') ?></th>
            <td><?= h($category->bg_uri) ?></td>
        </tr>
        <tr>
            <th><?= __('Icon Uri') ?></th>
            <td><?= h($category->icon_uri) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Coordinate X') ?></th>
            <td><?= $this->Number->format($category->coordinate_x) ?></td>
        </tr>
        <tr>
            <th><?= __('Coordinate Y') ?></th>
            <td><?= $this->Number->format($category->coordinate_y) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($category->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Uploaded') ?></th>
            <td><?= $category->uploaded ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $category->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Task') ?></h4>
        <?php if (!empty($category->task)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Category Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Uploaded') ?></th>
                <th><?= __('Enabled') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Info') ?></th>
                <th><?= __('Uri') ?></th>
                <th><?= __('Icon Uri') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->task as $task): ?>
            <tr>
                <td><?= h($task->id) ?></td>
                <td><?= h($task->category_id) ?></td>
                <td><?= h($task->created) ?></td>
                <td><?= h($task->uploaded) ?></td>
                <td><?= h($task->enabled) ?></td>
                <td><?= h($task->name) ?></td>
                <td><?= h($task->info) ?></td>
                <td><?= h($task->uri) ?></td>
                <td><?= h($task->icon_uri) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Task', 'action' => 'view', $task->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Task', 'action' => 'edit', $task->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Task', 'action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
