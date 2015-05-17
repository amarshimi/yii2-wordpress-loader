<?

namespace ravtech\wordpress\loader\controllers;

use Yii;
use yii\web\Controller;


class WpController extends Controller
{

    public function actionIndex()
    {

        $this->layout = 'application.modules.site.views.layouts.column2';

        try {
            $this->render('index');
            Yii::$app->end();
        }
            // if we threw an exception in a WordPress functions.php
            // when we find a 404 header, we could use our main Yii
            // error handler to handle the error, log as desired
            // and then throw the exception on up the chain and
            // let Yii handle things from here

            // without the above, WordPress becomes our 404 error
            // handler for the entire Yii app
        catch (\Exception $e) {
            throw $e;
        }
    }

    /* override default PageTitle to avoid yii's auto generated PageTitle */
    public function getPageTitle()
    {
        return '';
    }
}