<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
>>>>>>> b8b2ea3c2fbff74aa87e2e84fb99c6bfce542f5e

class M_status extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
    use SoftDeletes;
    use Userstamps;

    protected $table = "m_status";
    protected $primaryKey = "id_status";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
>>>>>>> b8b2ea3c2fbff74aa87e2e84fb99c6bfce542f5e
}
