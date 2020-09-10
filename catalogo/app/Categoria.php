<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //primary key
    protected $primaryKey = 'idCategoria';
    //created_at & updated_at
    public $timestamps = false;
}
