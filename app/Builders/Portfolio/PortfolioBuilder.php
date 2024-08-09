<?php

namespace App\Builders\Acount;

use App\ValueObjects\AccountId;

use App\DataTransferObjects\PortfolioData;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PortfolioBuilder extends Builder
{    
	public function portfolio(string $securitiesAccountId): Collection
	{
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		return DB::table('portfolios')
				->where('account_id',$securitiesAccountId)
				->latest()
				->get()
				->map(fn (object $data) => PortfolioData::fromArray((array) $data));					
	}
}
