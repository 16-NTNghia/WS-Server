<?php
namespace WorkSpace\Model;

class PricingPlan extends Entity
{
   protected $table = 'PRICING_PLAN';
   protected $primaryKey = 'IDPricingPlan';
   protected $fillable = ['IDPricing', 'IDUser', 'SubscribedAt', 'ExpiredAt', 'IsDeleted'];
   protected $attributes = [
      'SubscribedAt' => 'CURRENT_TIMESTAMP',
      'IsDeleted' => false,
   ];
   protected $timestamps = false;

   public function pricing()
   {
      return $this->belongsTo(Pricing::class, 'IDPricing', 'IDPricing');
   }

   public function user()
   {
      return $this->belongsTo(User::class, 'IDUser', 'IDUser');
   }
}