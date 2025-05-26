<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnggotaKeluarga extends Model
{
    //
    public function pekerjaans():HasMany
    {
        return $this->hasMany(Pekerjaan::class);
    }

    public function questionnaire():BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }
    // add fillable
    protected $fillable = [];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
}
