<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width,initial-scale=1" name=viewport>
  <link rel="stylesheet" href="../static/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../static/css/cover.css">
  <title><?=((view::$title) ? view::$title : DEFAULT_TITLE) ?></title>
</head>
<body>

  <div class="site-wrapper">
    <div class="site-wrapper-inner">
      <div class="cover-container">
        <header class="masthead clearfix">
          <div class="inner">
            <h3 class="masthead-brand">PHP-CF</h3>
          </div>
        </header>

        <?php include view::$content; ?>

        <footer class="mastfoot">
          <div class="inner">
            <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="../static/js/jquery.min.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>
  <script src="../static/js/popper.min.js"></script>
</body>
</html>
