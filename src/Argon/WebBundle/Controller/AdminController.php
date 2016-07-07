<?php

namespace Argon\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('ArgonWebBundle:Admin:dashboard.html.twig');
    }

    public function sinkAction()
    {
        return $this->render('ArgonWebBundle:Admin:sink.html.twig');
    }
}