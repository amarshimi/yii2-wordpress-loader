<?php

namespace amarshimi\wordpress\loader\components;

use Yii;
use yii\web\HttpException;

class ExceptionHandler
{
    public function __construct()
    {
        define('YII_ENABLE_EXCEPTION_HANDLER',false);
        set_exception_handler(array($this,'handleException'));
    }
 
    public function handleException($exception)
    {
        // disable error capturing to avoid recursive errors
        restore_error_handler();
        restore_exception_handler();
 
//        $event=new Exception($this,$exception);

        if($exception instanceof HttpException && $exception->statusCode == 404 && !isset($_GET['r']/*its not a bad tii request*/))
        {
            try
            {
                Yii::$app->runAction("wp/index");
            }
            catch(\Exception $exception) {
                
                var_dump($exception);
                die;
                
            }
            // if we throw an exception in Wordpress on a 404, we can use
            // our main error handler to handle the error
        }
 
//        if(!$event->handled)
//        {
//            Yii::$app->handleException($exception);
//        }
    }
}