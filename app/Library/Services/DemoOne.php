<?php
namespace App\Library\Services;

use App\Library\Services\Contracts\CustomServiceInterface;
  
class DemoOne implements CustomServiceInterface
{
    public function doSomethingUseful()
    {
      return 'Salida para juicio 1';
    }
}