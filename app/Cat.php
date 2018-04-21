<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{

    protected $fillable = [
        'name', 'color', 'worker_id', 'shelter_id',
    ];

    
    
    public function worker()
    {
        return $this->belongsTo('App\Worker');//dzieki temu przy kotach bedzie mozna nwyswietlic straznika
        //kot nalezy do 1 straznika
    }
    
    public function shelter()
    {
        return $this->belongsTo('App\Shelter');//dzieki temu przy kotach bedzie mozna nwyswietlic dane schroniska
        //kot nalezy do 1 schroniska
    }
    
    public function guardian()
    {
        return $this->worker();
    }
}
