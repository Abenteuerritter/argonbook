<?php

namespace Argon\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * User bundle of ArgonBook
 */
class ArgonUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}