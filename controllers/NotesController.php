<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class NotesController extends Controller
{
    public function userNotes(Request $request)
    {
        return $this->render('myNotesView');
    }

    public function inicio(Request $request)
    {
        return $this->render('home');
    }
}