<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //table define
    public $table = "student";
    protected $fillable = ['fname','lname','email','date','password','gender'];
    
    public function insert()
    {

    }

}