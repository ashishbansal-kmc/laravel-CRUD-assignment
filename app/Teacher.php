<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function scopeSpecificData($query){
    	$query->select('id','name','email','subject');
    }

    public function students(){
    	return $this->hasMany(Student::class);
    }
}
