<?php
namespace WorkSpace\Model;

class PricingFeature extends Entity
{
   protected $table = 'PRICING_FEATURE';
   protected $primaryKey = 'IDFeature';
   protected $fillable = ['IDPricing', 'Feature', 'IsDeleted'];

   public function pricing()
   {
      return $this->belongsTo(Pricing::class, 'IDPricing', 'IDPricing');
   }
}