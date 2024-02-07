<?php

namespace app\controllers;

use juanignaso\phpmvc\framework\Controller;

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