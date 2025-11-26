<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
  public function user(): BelongsTo{
    return $this->belongsTo(User::class);
        }

  public function rentImages(): HasMany{
    return $this->hasMany(RentImage::class);
  }

  public function bookings(): HasMany{
return $this->hasMany(Booking::class);
  }
    /** @use HasFactory<\Database\Factories\RentFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['brand', 'model', 'type', 'category', 'colour', 'year', 'rate'];
    static array $category = ['EV', 'Hybrid', 'Fuel'];
     public static array $type = ['SUV', 'Saloon', 'Bus', 'Van'];
     public static array $brand = ['Jaguar', 'Land Rover', 'Aston Martin', 'Bentley', 'Rolls-Royce', 'McLaren', 'Ford', 'Volkswagen',
   'BMW', 'Mercedes-Benz', 'Audi', 'Toyota', 'Honda', 'Nissan', 'Hyundai', 'Kia', 'Peugeot', 'Renault ', 'Vauxhall', 'Tesla'];

   public function scopeFilterrent(Builder $query, array $filters): Builder
   {
       return $query->when(
           $filters['rateFrom'] ?? false, 
           fn ($query, $value) => $query->where('rate', '>=', $value)
       )->when(
           $filters['rateTo'] ?? false,
           fn ($query, $value) => $query->where('rate', '<=', $value)
       )->when(
           $filters['model'] ?? false,
           fn ($query, $value) => $query->where('model', 'like', "%{$value}%")
       )->when(
         $filters['brand'] ?? false,
         fn ($query, $value) => $query->where('brand', 'like', "%{$value}%")
     )->when(
       $filters['year'] ?? false,
       fn ($query, $value) => $query->where('year', 'like', $value)
   )->when(
   $filters['category'] ?? false,
   fn ($query, $value) => $query->where('category', 'like', $value)
);
}
  }
