<?php

namespace App\Models;

use App\Builders\Account\AccountBuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
   use HasFactory;
	
   protected $table = 'accounts';
 
   protected $guarded = [];
	
   protected $fillable = [
	'pseudonymizedAccountId',
	'securitiesAccountId',
   ];
		
   public function user(): BelongsTo
   {
     return $this->belongsTo(User::class);
   }
	
   public function portfolio(): HasOne
   {
     return $this->hasOne(Portfolio::class);
   }
	
   public function transactions(): HasMany
   {
     return $this->hasMany(Transaction::class);
   }
	
   public function newEloquentBuilder($query): AccountBuilder
   {
     return new AccountBuilder($query);
   }	
}
