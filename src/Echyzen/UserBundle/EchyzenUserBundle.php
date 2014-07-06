<?php

namespace Echyzen\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EchyzenUserBundle extends Bundle
{
	public function getParent()
  {
    return 'FOSUserBundle';
  }
}
