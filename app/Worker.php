<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name', 'age',
    ];
    
    
    public function cats()
    {
        return $this->hasMany('App\Cat');//straznik ma wiele kotow do pilnowania
    }
    
//    $worker->cats()->saveMany([
//    new App\Cat(['message' => 'A new comment.']),
//    new App\Cat(['message' => 'Another comment.'])
//]);
}
