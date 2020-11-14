<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $primaryKey =	"role_id";


    protected $fillable =['displayname','description'];



    public $timestamps = false;


    public function users(){
    	return $this->hasMany('App\Models\users','login_id');
    }
}
