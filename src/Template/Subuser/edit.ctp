<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $subuser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $subuser->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Subuser'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Likes'), ['controller' => 'Likes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Like'), ['controller' => 'Likes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subuser form large-9 medium-8 columns content">
    <?= $this->Form->create($subuser) ?>
    <fieldset>
        <legend><?= __('Edit Subuser') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $user]);
            echo $this->Form->input('nick');
            echo $this->Form->input('avatar_url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
