<?php

namespace Argon\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function homepageAction()
    {
        return $this->render('ArgonWebBundle:Page:homepage.html.twig');
    }
}