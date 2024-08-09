<?php
namespace App\Builders\Position;

use App\ValueObjects\AccountId;
use App\DataTransferObjects\Position\PositionData;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PositionBuilder extends Builder
{   
	public function portfolioPositions(string $securitiesAccountId): Collection
	{
		$accountId = AccountId::from($securitiesAccountId);
		
		$securitiesAccountId = $accountId->securitiesAccountId();
		
		$portfolioId =  (int)DB::table('portfolios')->where('account_id',$securityAccountId)->first()->id; 
		
		return DB::table('positions')
					->where('portfolio_id',$portfolioId)
					->latest()
					->get()
					->map(fn (object $data) => PositionData::from((array) $data));						
	}
}
