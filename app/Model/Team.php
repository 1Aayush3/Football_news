<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Team extends Model implements HasMedia
{ 

    use HasMediaTrait;
    protected $table = "teams";
    protected $fillable = ['name','countries','formation','description', 'file'];    
    public function Player()
    {
        return $this->hasManyThrough('App\Player');
    }
}
