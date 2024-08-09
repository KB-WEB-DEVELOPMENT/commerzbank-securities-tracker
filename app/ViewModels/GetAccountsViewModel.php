<?php

namespace App\ViewModels;

use App\Models\User;

use Illuminate\Database\Eloquent\Collection;

class GetAccountsViewModel extends ViewModel
{
    public function __construct(
       private User $user,
       private ?Collection $accountsCollection
    ){}

    public function user(): User
    {
        return $this->user;
    }	

    public function accountsCollection(): ?Collection
    {
        return $this->accountsCollection;
    }
}
