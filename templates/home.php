<?php $this->layout('layouts::default', ['title' => 'Home']) ?>

<?php $this->start('style') ?>
<style>
  .links {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 1rem;
    align-items: flex-end;
    justify-content: center;

    padding: 2rem;
    background-color: #ffffff;

    border: 1px solid #e1e4e8;
    border-radius: 6px;
  }

  .links>div {
    display: flex;
    flex-flow: column wrap;
    align-items: center;
  }
  
  input {
    width: 60px;

    font: inherit;
    color: inherit;

    border: 1px solid #e1e4e8;
    border-radius: 4px;

    padding: 4px;

    text-align: center;
  }
</style>
<?php $this->stop() ?>

<?php $this->start('home') ?>
<h1>Home</h1>

<div class="links">
  <div>
    <a href="<?= $this->route('hello-world') ?>">Hello</a>
  </div>

  <div>
    <?php $defaultName = "🤓" ?>
    <?php $href = $this->route('hello-world', [], ['name' => $defaultName]) ?>
    <input class="dynamic-hello" type="text" value="<?= $defaultName ?>">
    <a href="<?= $href ?>">Hello <?= $defaultName ?></a>
  </div>
</div>
<?php $this->stop() ?>

<?php $this->start('script') ?>
<script defer>
  document.querySelector('.dynamic-hello').onkeyup = (e) => {
    const anchor = e.target.parentNode.querySelector('a');

    const url = new URL(anchor.href, window.location);
    url.searchParams.set('name', e.target.value);

    anchor.href = url;
    anchor.textContent = `Hello ${e.target.value}`;
  };
</script>
<?php $this->stop() ?>