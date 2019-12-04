<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    public $table = "goals";
    protected $fillable = ['match_id' , 'player_id' , 'match_time'];

    public function tables_match()
    {
        return $this->belongsto('App\Model\Match');
    }
    public function player()
    {
        return $this->belongsto('App\Model\Player','player_id');
    }

}
