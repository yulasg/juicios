<?php
// app/Library/Services/DemoTwo.php
namespace App\Library\Services;
  
use App\Library\Services\Contracts\CustomServiceInterface;
  
class DemoTwo implements CustomServiceInterface
{
    public function doSomethingUseful()
    {
      return 'Salida para Juicio 2';
    }
}