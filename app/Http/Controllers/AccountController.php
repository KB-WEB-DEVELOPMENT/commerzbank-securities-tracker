<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\ViewModels\GetAccountsViewModel;

use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    public function index(Request $request): Response
    {
        $user = Auth::user();
		
	$accountsCollection =  $user->accounts()->get();
					
	return Inertia::render('Accounts/Index', [
            'viewModel' => new GetAccountsViewModel($user,$accountsCollection)
        ]);
    }
}
