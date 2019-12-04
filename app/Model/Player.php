<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{   
    protected $table = "players";
    protected $fillable = ['first_name','last_name','date','country','team_id','description'];
    
    public function team()
    {
        return $this->belongsTo('App\Model\Team','team_id');//second parameter is foreign key
    }

    public function goals()
    {
        return $this->hasMany('App\Model\Goal');
    }
}
