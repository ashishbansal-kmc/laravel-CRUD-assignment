<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function scopeSpecificData($query){
    	$query->select('id','name','email','address');
    }
}
