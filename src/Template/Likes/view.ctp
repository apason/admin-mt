<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Like'), ['action' => 'edit', $like->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Like'), ['action' => 'delete', $like->id], ['confirm' => __('Are you sure you want to delete # {0}?', $like->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Likes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Like'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="likes view large-9 medium-8 columns content">
    <h3><?= h($like->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Subuser') ?></th>
            <td><?= $like->has('subuser') ? $this->Html->link($like->subuser->id, ['controller' => 'Subuser', 'action' => 'view', $like->subuser->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Answer') ?></th>
            <td><?= $like->has('answer') ? $this->Html->link($like->answer->id, ['controller' => 'Answer', 'action' => 'view', $like->answer->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($like->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($like->created) ?></td>
        </tr>
    </table>
</div>
