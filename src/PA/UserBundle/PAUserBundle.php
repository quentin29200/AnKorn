<?php

namespace PA\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PAUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
