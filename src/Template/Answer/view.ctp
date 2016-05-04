<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Answer'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Task'), ['controller' => 'Task', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Task', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Likes'), ['controller' => 'Likes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Like'), ['controller' => 'Likes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="answer view large-9 medium-8 columns content">
    <h3><?= h($answer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Task') ?></th>
            <td><?= $answer->has('task') ? $this->Html->link($answer->task->id, ['controller' => 'Task', 'action' => 'view', $answer->task->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Subuser') ?></th>
            <td><?= $answer->has('subuser') ? $this->Html->link($answer->subuser->id, ['controller' => 'Subuser', 'action' => 'view', $answer->subuser->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Answer Type') ?></th>
            <td><?= h($answer->answer_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Uri') ?></th>
            <td><?= h($answer->uri) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($answer->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($answer->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Uploaded') ?></th>
            <td><?= $answer->uploaded ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $answer->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    
    <?php
      // If the answer has been uploaded, we show the answer.
      if ($answer->uploaded == true): ?>
      <div>

      <?php if ($answer->answer_type == 'image'): ?>

        <img src="<?php print $signed_download_url; ?>">

      <?php endif; if ($answer->answer_type=='video'): ?>

        <video controls><source src="<?php print $signed_download_url; ?>"></video>

      <?php endif; ?>

    </div>
  <?php endif; ?>

    <div class="related">
        <h4><?= __('Related Likes') ?></h4>
        <?php if (!empty($answer->likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Subuser Id') ?></th>
                <th><?= __('Answer Id') ?></th>
                <th><?= __('Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($answer->likes as $likes): ?>
            <tr>
                <td><?= h($likes->id) ?></td>
                <td><?= h($likes->subuser_id) ?></td>
                <td><?= h($likes->answer_id) ?></td>
                <td><?= h($likes->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Likes', 'action' => 'view', $likes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Likes', 'action' => 'edit', $likes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Likes', 'action' => 'delete', $likes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $likes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
