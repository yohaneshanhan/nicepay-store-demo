<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Trans extends Model
{
    protected $table = 'tb_trans';
    protected $primaryKey = 'txid';
}