<?php
namespace WorkSpace\Model;

class Pricing extends Entity
{
   protected $table = 'PRICING';
   protected $primaryKey = 'IDPricing';
   protected $fillable = ['PricingName', 'Pricing', 'PricingDescription', 'ProjectLimit', 'TeamLimit', 'UnLimitedProjects', 'Duration', 'IsDeleted'];
   protected $attributes = [
      'UnLimitedProjects' => false,
      'IsDeleted' => false,
   ];

   public function plans()
   {
      return $this->hasMany(PricingPlan::class, 'IDPricing', 'IDPricing');
   }

   public function features()
   {
      return $this->hasMany(PricingFeature::class, 'IDPricing', 'IDPricing');
   }
}