<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="user view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Pin') ?></th>
            <td><?= h($user->pin) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Privacy Level') ?></th>
            <td><?= $this->Number->format($user->privacy_level) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $user->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Subuser') ?></h4>
        <?php if (!empty($user->subuser)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Nick') ?></th>
                <th><?= __('Avatar Url') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->subuser as $subuser): ?>
            <tr>
                <td><?= h($subuser->id) ?></td>
                <td><?= h($subuser->user_id) ?></td>
                <td><?= h($subuser->created) ?></td>
                <td><?= h($subuser->nick) ?></td>
                <td><?= h($subuser->avatar_url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subuser', 'action' => 'view', $subuser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subuser', 'action' => 'edit', $subuser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subuser', 'action' => 'delete', $subuser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subuser->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
