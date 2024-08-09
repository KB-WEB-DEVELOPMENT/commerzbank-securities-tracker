<?php

namespace App\Models;

use App\Builders\Portfolio\PortfolioBuilder;

use App\Collections\PortfolioCollection;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
	use HasFactory;

	protected $table = 'portfolios';
	 
	protected $guarded = [];
	
	protected $fillable = [
	
	    'creationDay',
        'effectiveDate',
		'securitiesAccountId',	
		'totalValue_amount',
		'totalValue_currency',
	];
	

	public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

	public function newEloquentBuilder($query): PortfolioBuilder
	{
		return new PortfolioBuilder($query);
	}

    public function newCollection(array $models = []): PortfolioCollection
    {
        return new PortfolioCollection($models);
    }
	
}