<?php

namespace App\Builders\Acount;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AccountBuilder extends Builder
{   
	public function securityAccoundIds(): Collection
	{
		return DB::table('accounts')
			     ->select('securitiesAccountId')
			     ->where('user_id',Auth::id())
			     ->latest()
			     ->get();											
	}	
}
