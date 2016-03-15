<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="user view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($user->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $user->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Answer') ?></h4>
        <?php if (!empty($user->answer)): ?>
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
            <?php foreach ($user->answer as $answer): ?>
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
