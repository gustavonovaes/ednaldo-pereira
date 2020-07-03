<?php $this->layout('layouts::default', ['title' => 'Login']) ?>

<?php $this->start('style') ?>
<style>
  .form-login {
    max-width: 330px;
  }
</style>
<?php $this->stop() ?>

<?php $this->start('body') ?>
<div class="d-flex flex-fill text-center">
  <form class="form-login m-auto w-100"
        action="<?= $this->route('login') ?>"
        method="POST">
    <img src=""
         alt=""
         height="72"
         width="72"
         class="mb-4">

    <h1 class="h3 mb-3 font-weight-normal">App Login</h1>

    <label for="inputEmail"
           class="sr-only">Email address</label>
    <input type="email"
           name="email"
           id="inputEmail"
           class="form-control mb-2 ip-3"
           placeholder="Email address"
           required />

    <label for="inputPassword"
           class="sr-only">Password</label>
    <input type="password"
           name="password"
           id="inputPassword"
           class="form-control mb-2 ip-3"
           placeholder="Password"
           required />

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox"
               name="remember"
               value="remember" /> Remember me
      </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block"
            type="submit">Login</button>

  </form>

</div>

</form>
<?php $this->stop() ?>

<?php $this->start('script') ?>
<script defer>

</script>
<?php $this->stop() ?>