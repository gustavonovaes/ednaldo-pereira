<?php $this->layout('layouts::default', ['title' => 'Hello ' . $name]) ?>

<?php $this->start('home') ?>
<a href="<?= $this->route('home') ?>">Back</a>

<h1>Hello, <?= $this->e($name) ?></h1>
<?php $this->stop() ?>