<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    //

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function pekerjaans(): HasMany
    {
        return $this->hasMany(Pekerjaan::class);
    }

    public function anggotaKeluargas(): HasMany
    {
        return $this->hasMany(AnggotaKeluarga::class);
    }

    // add fillable
    protected $fillable = [];
    // add guaded
    protected $guarded = [
        'id',
        'survey_id',
    ];
    // add hidden
    protected $hidden = [
        'r_201',
        'r_202',
        'r_203',
        'r_204',
        'r_205',
        'r_206',
        'r_207',
        'r_208',
        'r_209',
        'r_210',
        'r_211',
        'r_212',
        'r_302',
        'r_303',
        'r_304',
        'r_305',
        'r_302_a',
        'r_302_b',
        'r_302_c',
        'r_302_d',
        'r_302_e',
        'r_303_a',
        'r_303_b',
        'r_303_c',
        'r_304_a',
        'r_304_b',
        'r_304_c',
        'r_305_a',
        'r_305_b',
        'r_305_c',
        'r_305_d',
        'r_305_e',
    ];

    protected $casts = [
        'r_200' => 'json',
    ];
}
