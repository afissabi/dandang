<?php

namespace App\Models\web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_galeri extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_galeri";
    protected $primaryKey = "id_galeri";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
