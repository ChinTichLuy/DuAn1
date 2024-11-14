<?php
namespace App\Commons;
use eftec\bladeone\BladeOne;
use Rakit\Validation\Validator;

abstract class Controller{

    protected $validator;

    pu

    public function renderView($view,$data,$type): void{
        $tempPath = __DIR__ ."/../Views/{$type}";
        $cache = __DIR__ ."/../Views/Compiles";
        $blade = new BladeOne($tempPath,$cache);
        echo $blade->run($view,$data);
    }

    public function viewAdmin($view,$data = []){
        return $this-> renderView($view,$data,'Admin');
    }
    public function viewClient($view,$data = []){
        return $this-> renderView($view,$data,'Client');

    }
}