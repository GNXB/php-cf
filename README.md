# php-cf
PHP Conceptual Framework (0.7-alpha)

Just a Simple Framework with no-need to learn any new command or syntax, organize PHP projects to be cleaned.

## Key Features
- **php-cf** written in Pure-PHP no need to install anything
- Role-Based Controller (controller in MVC Concept). It's hard to make cross-function hacking and privilege escalation. Except, the weakness secured in development.
- Code Environment designed from experience, clean and simple to use.
- Re-Organize the way of developing PHP Project
- App Logic is reusable by suggesting you to write any class as a service

## Getting Started
Understanding what the framework provide


**Clone project**
to your prepared Web Server and make sure that `mod_rewrite` is enabled to directory.

### 0) Framework Structure
- `/app` receive data from users and contains a Back-End file, API. But does not handle any logical action. The logical action such as retrieving data from database, should be placed in `/server`.
- `/controller` contains routers based on authorization zone.
- `/engine` contains
  - `engine.php` file that is a middleware of web
  - `global.php` that has all global constant
  - Others is framework libraries
- `/library` your vendor library file will be placed here.
- `/service` contains logic of the project and the logic is reusable.
- `/static` contains static contents such as CSS, Fonts, JavaScript file, Image, etc.
- `/view` contains views that appears on browser.

### 1) Engine Layer

**1.1) Start from `.htaccess` file**
```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ ./index.php?__path=$1 [NC,L,QSA]
```
Every HTTP Request will be called through the `index.php`

**1.2) Next, `index.php` file**
```PHP
<?php

define('ROOT', dirname(__FILE__));
require 'engine/engine.php';
```
It defined `ROOT` constant and included `engine/engine.php` file.

**1.3) Middle-Ware, `engine/engine.php` file**
- Session
- Global Variables
- Our provided Libraries (system library)
- Database Connection
- Authorized Section (Main Router)
- etc., what you want to declare

will go here, REMEMBER only constant and static class method which defined in `engine/engine.php` can be called from App Layer.

```PHP
controller::authorization(
  authority::$level,
  [
    "admin" => CONTROLLER . "/admin.router.php"
  ]
);
```

This is how framework controls authority zone based on "Role Name". The user who granted authorization with role **"Admin"** will be taken `controller/admin.router.php` to route to any page and who did not have any authorization (like a **"Public Visitor"**) will be taken `DEFAULT_ROUTER` (`DEFAULT_ROUTER` is defined in `engine/global.php`)

```PHP
define("DEFAULT_ROUTER", CONTROLLER . "/public.router.php");
```

**1.4) Authorize user**
Take a look in `/service/Authen.php` you will find class `Authen` with `login()` function
```PHP
public static function login() {
  authority::set("admin");
}
```
The `authority::set("admin");` is command to set a authorized role to user

### 2) Controller Layer
Take a look on `/controller` you will find `*.router.php`

It works like **Access Control List** concept. Rules will be matched from top to bottom.

`router` and `view` class are do the same thing but `view` has a more feature that can handle the layout, mean that it will call layout before and then call target file (If you never defined any layout before, it will call target file suddenly).

`$regex` the framework uses RegEx (Regular Expression) to handle Sub-URL

#### `router::get($regex, "path/to/app_file.php");`
Handle HTTP requesting on method GET and call destination file
#### `router::post($regex, "path/to/app_file.php");`
Handle HTTP requesting on method POST and call destination file
#### `router::request($regex, "path/to/app_file.php");`
Handle HTTP requesting on both of method GET,POST and call destination file

#### `view::layout('view/main.layout.php');`
Set view layout, it will apply for the following handler HTTP requesting below.
#### `view::get($regex, "path/to/view_file.php");`
Handle HTTP requesting on method GET and call destination file
#### `view::post($regex, "path/to/view_file.php");`
Handle HTTP requesting on method POST and call destination file
#### `view::request($regex, "path/to/view_file.php");`
Handle HTTP requesting on both of method GET,POST and call destination file

### 3) App Layer / View Layer
In this layer, you cannot access any variable defined in `/engine/engine.php` but you still able to call constant and static class. That why I suggest you to define database connection in `/engine/engine.php`, and others thing like Multiple-DB Connection, API Classes.

#### 3.1) App Layer
is anything in `/app` that contain programming logic is executed by **Controller Layer** and do `echo` or `print` anything to response.

#### 3.2) View Layer
is anything in `/view` that contain markup or any text that will be presented to browser. There is two kinds of file
- View file - its file extension is `.php` contains markup or any text.
- Layout file - its file extension is `.layout.php` contains markup or any text that enclose view file
**Controller Layout** will call layout file first (if you set layout before handling view) and then view file.

##### 3.2.1) How to make `.layout.php` file
You might have a HTML Markup look like this below
```HTML
<!DOCTYPE html>
<html>
<head>...</head>
<body>
  <header>
    <nav>...</nav>
  </header>

  <div id="app">
    <!-- Only here is unique -->
    <!-- View goes here -->
  </div>

  <footer>...</footer>
</body>
</html>
```

To call **View Files**, just put `include view::$content;`

```PHP
<div id="app">
  <?php include view::$content; ?>
</div>
```

Then, **View** will be placed in that position.


##### 3.2.2) How to set webpage's title
There is many ways to set webpage title, on simple website you can change the title by adding `view::setTitle('Your Title');` to **router**.

You can see the example in `/controller/admin.router.php`

```PHP
...
view::layout("view/admin/admin.layout.php");
view::setTitle("Welcome to PHP-CF | Administrator");
view::get("about", "view/admin/about.php");
...
```

like `view::layout()` command, it will apply to others handle below until it find others `view::layout()` again. If you need a view to use default title, you just place it before any `view::layout()` command.

---

## Requirements
- Apache 2.4 (Haven't tested on other version yet)
- PHP 5.6
- Enable mod_rewrite
