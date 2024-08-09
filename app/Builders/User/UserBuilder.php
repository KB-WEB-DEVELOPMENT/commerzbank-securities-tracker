<?php
namespace App\Builders\User;

use Illuminate\Support\Facades\Auth;

use App\ValueObjects\AccountId;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserBuilder extends Builder
{  
	public function securitiesAccountIds(): array
	{
		return DB::table('accounts')
					->select('securitiesAccountId')
					->where('user_id',Auth::id())
					->latest()
					->get();					
	}	
}
