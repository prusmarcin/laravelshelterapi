<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    
    protected $fillable = [
        'uskey', 'name', 'city', 'size',
    ];
    
    /**
     * Static method generate rand string
     *
     * @return Return string with 5 long chars
     */
    public static function generateUSKey()
    {
        $hash = md5(time().rand(1000, 1000000));
        return substr($hash, 0, 5);
    }
    
    public function workers()
    {
        return $this->hasMany('App\Worker');//schronisko ma wiele pracownikow
    }
    
    public function cats()
    {
        return $this->hasMany('App\Cat');//schronisko ma wiele kotow
    }
}
