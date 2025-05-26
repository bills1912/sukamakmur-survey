<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    //
    public function questionnaires():HasMany {
        return $this->hasMany(Questionnaire::class);
    }

    // add fillable
    protected $fillable = ['id', 'nama_survey'];
    // add guaded
    // protected $guarded = ['id'];
    // add hidden
    // protected $hidden = ['created_at', 'updated_at'];
}
