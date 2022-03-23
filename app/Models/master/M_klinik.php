<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_klinik extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_klinik";
    protected $primaryKey = "id_klinik";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function stat()
    {
        return $this->belongsTo('App\Models\Master\M_status', 'status');
    }
}
