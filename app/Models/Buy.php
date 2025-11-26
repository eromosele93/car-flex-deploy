<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buy extends Model
{
    /** @use HasFactory<\Database\Factories\BuyFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['brand', 'model', 'type', 'category', 'colour', 'year', 'price'];
    public
     static array $category = ['EV', 'Hybrid', 'Fuel'];
     public static array $type = ['SUV', 'Saloon', 'Bus', 'Van'];
     public static array $brand = ['Jaguar', 'Land Rover', 'Aston Martin', 'Bentley', 'Rolls-Royce', 'McLaren', 'Ford', 'Volkswagen',
   'BMW', 'Mercedes-Benz', 'Audi', 'Toyota', 'Honda', 'Nissan', 'Hyundai', 'Kia', 'Peugeot', 'Renault ', 'Vauxhall', 'Tesla'];



   public function user(): BelongsTo{
    return $this->belongsTo(User::class);
        }

    public function offers(): HasMany{
      return $this->hasMany(Offer::class);
    }
    public function buyImages(): HasMany{
        return $this->hasMany(BuyImage::class);
    }
   public function scopeFilterbuy(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['priceFrom'] ?? false, 
            fn ($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? false,
            fn ($query, $value) => $query->where('price', '<=', $value)
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
public function scopeWithoutSold(Builder $query): Builder{
    //without sold_at column
// return $query->doesntHave('offers')
// ->orWhereHas('offers', fn (Builder $query) => $query->whereNull('accepted_at')->whereNull('rejected_at'));

return $query->whereNull('sold_at');
}

}
