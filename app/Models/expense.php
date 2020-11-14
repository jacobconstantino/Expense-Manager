<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    use HasFactory;

    protected $table = 'expense';

    protected $primaryKey ='expense_id';

    protected $fillable = ['category_id','amount','entry','user_id'];


    public $timestamps = false;


     public function category(){
    	return $this->belongsTo('App\Models\category_expense','category_id');
    }

     public function user(){
    	return $this->belongsTo('App\Models\users','user_id');
    }
}

