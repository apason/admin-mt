<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Like'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="likes index large-9 medium-8 columns content">
    <h3><?= __('Likes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('subuser_id') ?></th>
                <th><?= $this->Paginator->sort('answer_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($likes as $like): ?>
            <tr>
                <td><?= $this->Number->format($like->id) ?></td>
                <td><?= $like->has('subuser') ? $this->Html->link($like->subuser->id, ['controller' => 'Subuser', 'action' => 'view', $like->subuser->id]) : '' ?></td>
                <td><?= $like->has('answer') ? $this->Html->link($like->answer->id, ['controller' => 'Answer', 'action' => 'view', $like->answer->id]) : '' ?></td>
                <td><?= h($like->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $like->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $like->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $like->id], ['confirm' => __('Are you sure you want to delete # {0}?', $like->id)]) ?>
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
