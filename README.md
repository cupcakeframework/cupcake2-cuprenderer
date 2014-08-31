cupcake2-cuprenderer
==================

CupCake2 Framework - Template Engine
A Simple PHP Template Engine (oldschool style, uses good old <?php tag :)

Usage:
--------------


Your Controller File
--------------

```php

require_once __DIR__ . '/vendor/autoload.php';

$templatesFolder = array(__DIR__.'/templates/');
$viewsFolder = array(__DIR__.'/views/');
$renderer = new CupRenderer($templatesFolder,$viewsFolder);

$renderer->setTemplateFile('my_template.php');

$bar = 'bar';

$renderer->render('myViewFile.php',array('foo'=>'Foo','bar'=>$bar));


```

Your TemplateFile
--------------

```php

<!DOCTYPE HTML>
<html>     
    <head>
        <title>My Template File</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
    </head>
    <body>
        <?php
            echo $content;
        ?>
    </body>
</html>

```


Your View File
--------------

```php

<h1>Foo is <?=$foo?><h1>
<p>Bar is <?=$bar?><>
```

PS:
--------------
You can use it standalone with Silex :)
Check the provider folder for more information.