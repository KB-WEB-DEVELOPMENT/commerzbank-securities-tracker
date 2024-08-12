<?php

namespace App\ValueObjects;

class FromTradingDate
{
    public function __construct(
      private readonly DateTime $unformattedDate
    ){}

    public static function from(string $unformattedDate): self
    {						
       if (date_create($unformattedDate) == false) {
	  throw new Exception('The value of the variable you provided cannot be converted into a proper date.');	
	}
	    
	return new static(date_create($unformattedDate));
    }

    public function format(): string
    {
       return date_format($this->unformattedDate,'Y-m-d'); 
    }
}
