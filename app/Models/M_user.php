<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_user extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_user";
    protected $primaryKey = "id_user";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function role()
    {
        return $this->belongsTo('App\Models\master\M_role', 'role_id');
    }
}
