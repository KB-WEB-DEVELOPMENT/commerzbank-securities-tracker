<?php

namespace App\Filters;

use App\ValueObjects\FromTradingDate;
use App\ValueObjects\ToTradingDate;

class TransactionsDateFilter
{
    public function __construct(
        public string $fromTradingDateString,
        public string $toTradingDateString
    ) {}

    public static function from(string $fromTradingDateString,string $toTradingDateString): self
	{
		if (!(strtotime($fromTradingDateString) instanceof DateTime)) {
			throw new Exception('Your $fromTradingDateString parameter cannot be converted into a proper date.');
		}
		
		if (!(strtotime($toTradingDateString) instanceof DateTime)) {
			throw new Exception('Your $toTradingDateString parameter cannot be converted into a proper date.');
		}
				
		$diff = strtotime($toTradingDateString)- strtotime($fromTradingDateString);
		
		if ($diff <= 0) {
			throw new Exception('Your $fromTradingDateString and $toTradingDateString parameters do not follow a logical time sequence.');
		}	
		
		return new static(
			FromTradingDate::from($fromTradingDateString)->format(),
			ToTradingDate::from($toTradingDateString)->format()
		);
    }
}
