<?php

namespace App\ViewModels;

use App\ValueObjects\AccountId;

use App\Models\User;
use App\Models\Portfolio;
use App\Models\Position;

use App\Collections\PortfolioCollection;

use Illuminate\Database\Eloquent\Collection;

class GetPortfolioViewModel extends ViewModel
{
    public function __construct(
       private User $user,
       private string $securitiesAccountId,
       private ?Portfolio $portfolio = null,
       private ?Collection $positionsCollection = null,
       private ?Position $position = null		
    ){}
		
    public function positionsCollection(): ?Collection
    {
        return $this->positionsCollection;	
    }
		
    public function averagePayoutPerPosition(): float
    {
       $portfolioCollection = new PortfolioCollection();
		
        return $portfolioCollection->averagePayoutPerPosition($this->securitiesAccountId);		
    }
}
