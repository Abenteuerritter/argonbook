<?php

namespace Argon\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('admin:dashboard.html.twig');
    }

    public function sinkAction()
    {
        return $this->render('admin:sink.html.twig');
    }
}