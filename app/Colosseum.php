<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colosseum extends Model
{
    protected $table = 'colosseums';
    protected $fillable = ['rival', 'outcome', 'lifeforce_our', 'lifeforce_theirs', 'colosseum_date', 'colosseum_type'];
}
