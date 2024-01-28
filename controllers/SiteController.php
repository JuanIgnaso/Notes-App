<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    /**
     * Carga la página de inicio del sitio
     * 
     */
    public function homePage()
    {
        $this->setLayout('homeLayout');

        return $this->render('home');
    }
}