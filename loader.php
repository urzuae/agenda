<?php
spl_autoload_register('system_loader');
spl_autoload_register('models_loader');
spl_autoload_register('controller_loader');

function system_loader($className)
{
  $path = './system/';

  $file = $path.$className.'.php';

  if (file_exists($file))
    include $file;
}

function models_loader($className)
{
  $path = './models/';

  $file = $path.$className.'.php';

  if (file_exists($file))
    include $file;
}

function controller_loader($className)
{
  $path = './controllers/';

  $file = $path.$className.'.php';

  if (file_exists($file))
    include $file;
}