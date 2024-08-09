<?php

namespace App\Services;

use App\Services\Commerzbank\DataTransferObjects\TransactionsData;

class TransactionsService
{
    public function __construct(
    ){}

    public function transactions(): TransactionsData
    {		
       $transactionsArray  = [];
		
       $transactionsArray = include('../../storage/imports/transactions.php');
		
       $transactionsData = TransactionsData::fromArray($transactionsArray);

       return $transactionsData; 
     }
}	
