<?php

namespace Mvc\Core\Views;

use Mvc\Core\View;

interface hasLayout {

    public function setLayout($layout);
}

interface hasTemplate {

    public function setTemplate($template);
}

interface hasData {

    public function setData($data);
}

class viewBase extends View{
    
}