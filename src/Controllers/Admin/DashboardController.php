<?php

namespace Ngogi\Xuongphp\Controllers\Admin;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;

class DashboardController extends Controlller
{
    public function dashboard() {


        $this->renderViewAdmin(__FUNCTION__);
    }
}