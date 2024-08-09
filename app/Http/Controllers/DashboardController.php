<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\ViewModels\GetDashboardViewModel;

use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request):Response
    {       
       $user = Auth::user();

	return Inertia::render('Dashboard', [
            'viewModel' => new GetDashboardViewModel($user)
        ]);
    }
}
