<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pekerjaan extends Model
{
    //
    public function anggotaKeluarga():BelongsTo
    {
        return $this->belongsTo(AnggotaKeluarga::class);
    }

    // add fillable
    protected $fillable = [];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
}
