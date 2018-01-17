<?php

router::request("auth/([a-z]+)", "app/auth.php");

view::layout("view/main.layout.php");
view::get("/", "view/home.php");
view::get("", "view/404.php");
