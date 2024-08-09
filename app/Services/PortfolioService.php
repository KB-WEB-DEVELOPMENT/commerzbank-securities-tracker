<?php

namespace App\Services;

use App\Services\Commerzbank\DataTransferObjects\PortfolioData;
use App\Services\Commerzbank\DataTransferObjects\PositionsData;

class PortfolioService
{
    public function __construct(
    ){}

    public function portfolio(): PortfolioData
    {		
      $portfolioArray = [];
		
      $portfolioArray = include('../../storage/imports/portfolio.php');
		
      $portfolioData = PortfolioData::fromArray($portfolioArray);

      return $portfolioData; 
    }
}	
