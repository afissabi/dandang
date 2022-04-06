<?php

namespace App\Models\web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_about extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_about";
    protected $primaryKey = "id_about";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}