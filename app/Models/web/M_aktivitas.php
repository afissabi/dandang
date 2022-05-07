<?php

namespace App\Models\web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_aktivitas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_aktivitas";
    protected $primaryKey = "id_aktivitas";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
