<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_poli extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_poli";
    protected $primaryKey = "id_poli";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function klinik()
    {
        return $this->belongsTo('App\Models\Master\M_klinik', 'klinik_id');
    }
}
