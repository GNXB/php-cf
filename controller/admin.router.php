<?php

router::request("auth/(logout)", "app/auth.php");

view::layout("view/admin/admin.layout.php");
view::get("about", "view/admin/about.php");
view::get("/", "view/admin/home.php");
view::get("", "view/admin/404.php");
