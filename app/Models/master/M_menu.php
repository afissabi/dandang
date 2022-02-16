<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_menu";
    protected $primaryKey = "id_menu";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
