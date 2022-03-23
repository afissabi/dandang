<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_status extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "m_status";
    protected $primaryKey = "id_status";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
