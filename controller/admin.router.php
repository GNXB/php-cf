<?php

router::request("auth/(logout)", "app/auth.php");

view::layout("view/admin/admin.layout.php");
view::setTitle("Welcome to PHP-CF | Administrator");
view::get("about", "view/admin/about.php");
view::get("/", "view/admin/home.php");
view::get("", "view/admin/404.php");
