cupcake2-cuprenderer
==================
This is the CupRenderer provider for use with Silex

Example Usage:
--------------
```php
use Silex\Application;
use Silex\Provider\CupRendererProvider;

$app = new Application();
$app->register(new CupRendererProvider(), array(
    'cuprenderer.templatesFolder' => array(
        __DIR__ . '/src/templates/'
    ),
    'cuprenderer.viewsFolder' => array(
        __DIR__ . '/src/views/'
    ),
));
$app['cuprenderer']->render('myViewFile.php');
```