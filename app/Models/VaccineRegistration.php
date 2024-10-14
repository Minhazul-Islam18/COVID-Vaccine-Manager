<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaccineRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'nid', 'vaccine_center_id', 'status', 'vaccination_date'];

    /**
     * Get the vaccineCenter that owns the VaccineRegistration
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vaccineCenter(): BelongsTo
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
