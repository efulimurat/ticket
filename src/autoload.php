<?php

function psr0($class)
{
    $parts = explode('\\', $class);
    require end($parts) . '.php';
}

spl_autoload_register('psr0');