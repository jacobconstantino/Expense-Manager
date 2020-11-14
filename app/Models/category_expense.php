<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_expense extends Model
{
    use HasFactory;


    protected $table = 'category_expense';

    protected $primaryKey = 'category_id';


    protected $fillable = ['name','description'];


    public $timestamps = false;

     public function expense(){
    	return $this->hasMany('App\Models\expense','category_id');
    }
}
