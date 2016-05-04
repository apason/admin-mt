<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subuser'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Likes'), ['controller' => 'Likes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Like'), ['controller' => 'Likes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subuser index large-9 medium-8 columns content">
    <h3><?= __('Subuser') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('nick') ?></th>
                <th><?= $this->Paginator->sort('avatar_url') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subuser as $subuser): ?>
            <tr>
                <td><?= $this->Number->format($subuser->id) ?></td>
                <td><?= $subuser->has('user') ? $this->Html->link($subuser->user->id, ['controller' => 'User', 'action' => 'view', $subuser->user->id]) : '' ?></td>
                <td><?= h($subuser->created) ?></td>
                <td><?= h($subuser->nick) ?></td>
                <td><?= h($subuser->avatar_url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subuser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subuser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subuser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subuser->id)]) ?>
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
