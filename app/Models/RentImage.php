<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentImage extends Model
{
    protected $fillable = ['filename'];
    protected $appends = ['src'];
    public function rent(): BelongsTo{
        return $this->belongsTo(Rent::class);
    }
    public function getSrcAttribute(){
        return asset("storage/{$this->filename}");
    }
}
