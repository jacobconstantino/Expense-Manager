<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;



    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = ['Name','Email','role_id','password'];


    public $timestamps = false;



    public function roles(){
    	return $this->belongsTo('App\Models\roles','role_id');
    }

    public function exepense(){
    	return $this->hasMany('App\Models\expense','user_id');
    }
}
