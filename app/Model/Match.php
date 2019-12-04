<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{  
    public $table = "table_matches";
    protected $fillable = ['home_team_id', 'away_team_id','match_time','status'];

    public function goals()
    {
        return $this->hasMany('App\Model\Goal');
    }
    public function home_team()
    {
        return $this->belongsTo('App\Model\Team','home_team_id');//second parameter is foreign key
    }
    public function away_team()
    {
        return $this->belongsTo('App\Model\Team','away_team_id');//second parameter is foreign key
    }
}
