<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=((view::$title) ? view::$title : DEFAULT_TITLE) ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/static/css/bootstrap4.min.css" rel="stylesheet">
    <link href="/static/css/admin.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">PHP-CF</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <a href="/auth/logout" class="btn btn-outline-warning my-2 my-sm-0">Logout</a>
        </div>
      </div>
    </nav>

    <?php include view::$content; ?>

    <footer class="container">
      <p>&copy; Company 2017</p>
    </footer>

    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/popper.min.js"></script>
    <script src="/static/js/bootstrap4.min.js"></script>
  </body>
</html>
