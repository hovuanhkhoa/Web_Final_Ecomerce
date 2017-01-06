<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $primaryKey = 'ID';
    protected $uniqueKey = 'Identify_number';
}
