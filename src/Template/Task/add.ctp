<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading">Toiminnot</li>
        <li><?= $this->Html->link('Listaa tehtävät', ['action' => 'index']) ?></li>
        <li><?= $this->Html->link('Listaa kategoriat', ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link('Uusi kategoria', ['controller' => 'Category', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link('Listaa vastaukset', ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link('Uusi vastaus', ['controller' => 'Answer', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="task form large-9 medium-8 columns content">
    <?= $this->Form->create($task) ?>
    <fieldset>
        <legend>Lisää uusi tehtävä</legend>
        <?php
            echo $this->Form->input('category_id', ['options' => $category]);
            // echo $this->Form->input('uploaded');
            // echo $this->Form->input('enabled');
            echo $this->Form->input('name');
            echo $this->Form->input('info');
            // echo $this->Form->input('uri');
            // echo $this->Form->input('icon_uri');
        ?>
    </fieldset>
    <?= $this->Form->button('Lisää') ?>
    <?= $this->Form->end() ?>
</div>
