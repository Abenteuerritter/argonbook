<?php

namespace Argon\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function homepageAction()
    {
        return $this->render('pages/homepage.html.twig');
    }
}