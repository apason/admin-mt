<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Likes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subuser'), ['controller' => 'Subuser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subuser'), ['controller' => 'Subuser', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="likes form large-9 medium-8 columns content">
    <?= $this->Form->create($like) ?>
    <fieldset>
        <legend><?= __('Add Like') ?></legend>
        <?php
            echo $this->Form->input('subuser_id', ['options' => $subuser]);
            echo $this->Form->input('answer_id', ['options' => $answer]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
