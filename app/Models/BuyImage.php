<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuyImage extends Model
{
    
    protected $fillable = ['filename'];
    protected $appends = ['src'];
    public function buy(): BelongsTo{
        return $this->belongsTo(Buy::class);
    }
    public function getSrcAttribute(){
        return asset("storage/{$this->filename}");
    }
}
