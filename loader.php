<?php
spl_autoload_register('auto_loader');

function auto_loader($className)
{
    $path = './system/';

    include $path.$className.'.php';
}