<?php 

namespace Ngogi\Xuongphp\Commons;

use eftec\bladeone\BladeOne;

class Controlller {
    protected  function renderViewClient($view,$data) {
        $templatePath = __DIR__  . '/../Views/Client'; 
        $compiledPath = __DIR__ . '/../Views/Compiles';

        $blade = new BladeOne($templatePath, $compiledPath);

        echo $blade->run($view , $data);
    }


    protected function renderViewAdmint($view,$data) {
        $templatePath = __DIR__  . '/../Views/Admin'; 
        $compiledPath = __DIR__ . '/../Views/Compiles';

        $blade = new BladeOne($templatePath, $compiledPath);

        echo $blade->run($view , $data);
    }
}