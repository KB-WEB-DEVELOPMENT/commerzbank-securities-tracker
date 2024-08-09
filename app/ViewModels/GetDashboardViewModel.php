<?php

namespace App\ViewModels;

use App\Models\User;

class GetDashboardViewModel extends ViewModel
{
    public function __construct(
      private User $user
    ){}
}
