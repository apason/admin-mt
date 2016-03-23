<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subuser'), ['action' => 'edit', $subuser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subuser'), ['action' => 'delete', $subuser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subuser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subuser'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subuser'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subuser view large-9 medium-8 columns content">
    <h3><?= h($subuser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nick') ?></th>
            <td><?= h($subuser->nick) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $subuser->has('user') ? $this->Html->link($subuser->user->id, ['controller' => 'User', 'action' => 'view', $subuser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($subuser->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Answer') ?></h4>
        <?php if (!empty($subuser->answer)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Issued') ?></th>
                <th><?= __('Loaded') ?></th>
                <th><?= __('Enabled') ?></th>
                <th><?= __('Task Id') ?></th>
                <th><?= __('Subuser Id') ?></th>
                <th><?= __('Uri') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subuser->answer as $answer): ?>
            <tr>
                <td><?= h($answer->id) ?></td>
                <td><?= h($answer->issued) ?></td>
                <td><?= h($answer->loaded) ?></td>
                <td><?= h($answer->enabled) ?></td>
                <td><?= h($answer->task_id) ?></td>
                <td><?= h($answer->subuser_id) ?></td>
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
