<?php

namespace Horoshop\Test\Controllers;

use Horoshop\Test\View\View;
use Horoshop\Test\src\Models\Template;

/**
 * Class Homepage
 *
 * @package Controllers
 */
class HomepageController extends BaseController
{
    public function actionIndex()
    {
        $template = new Template();

        $templates = $template->GetTemplatesWithPage();


        //echo('<pre>');print_r($view->getParams()['templates']);echo('<pre>');
        $this->view->generate('homepage.php',  ['templates' => $templates]);
    }
}
