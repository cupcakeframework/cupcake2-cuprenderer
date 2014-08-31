<?php

/**
 * Silex Adapter for CupRenderer
 * @author Ricardo Fiorani
 */

namespace Cupcake2\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;
use CupCake2\Core\CupRenderer;

class CupRendererProvider implements ServiceProviderInterface {

    public function boot(Application $app) {
        $app['cuprenderer'] = $app->share(function ($app) {
            $cupRenderer = new CupRenderer($app['cuprenderer.templatesFolder'], $app['cuprenderer.viewsFolder']);
            $cupRenderer->insertGlobal(array('app' => $app));
            return $cupRenderer;
        });
    }

    public function register(Application $app) {
        
    }

}
