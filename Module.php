<?php

namespace amarshimi\wordpress\loader;

use amarshimi\wordpress\loader\components\ExceptionHandler;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $wordpressPath = '';


    public function bootstrap($app){
        
        /* wordpress */

        define('WP_USE_THEMES', true);

        $wp_did_header = true;

        require_once( $this->wordpressPath.'/wp-load.php' );

        require_once(__DIR__ . '/components/ExceptionHandler.php');

        $router = new ExceptionHandler();

    }
}
