<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet"
        href="/css/main.css">

  <title><?= $this->e($title ?? 'Default Title') ?></title>

  <?= $this->section('style', '') ?>

  <script src="/js/main.js"></script>
</head>

<body class="d-flex flex-column bg-secondary">
  <?= $this->section('body') ?>

  <script defer
          src="/js/vendor.js"></script>

  <script defer>
    docReady(() => feather.replace());
  </script>

  <?= $this->section('script', '') ?>
</body>

</html>