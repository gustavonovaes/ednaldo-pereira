<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->e($title ?? 'Default Title') ?></title>

  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }

    body {
      min-height: 100vh;

      text-rendering: optimizeLegibility;
      line-height: 1.5;

      background-color: #f6f8fa;  
      color: #24292e;

      font-size: 16px;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;

      padding: 15px;

      display: flex;
      flex-flow: column wrap;
      justify-content: space-between;
      align-items: center;
    }
    
    a {
      text-decoration: none;
      font-weight: bold;
      color: inherit;
    } 

    a:hover {
      color: #0366d6;
    }
  </style>

  <?= $this->section('style', '') ?>
</head>

<body>
  <?= $this->section('home') ?>

  <?= $this->section('script', '') ?>

  <?= $this->insert('includes::footer', ['version' => $version]) ?>
</body>

</html>