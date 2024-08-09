<?php

namespace App\ValueObjects;

class AccountId
{
    public function __construct(
		private readonly string $securitiesAccountId,
	){}

    public static function from(string $securitiesAccountId): self
    {
		$pattern = "/^[0-9]{12,13}$/";
		$found = preg_match($pattern,$securitiesAccountId);

		if (!$found) {
			throw new Exception('Your $securitiesAccountId variable format does not match the format Commerzbank expects.');
		}

		return new static($securitiesAccountId);
    }
	
	public function securitiesAccountId(): string
    {
       return $this->securitiesAccountId;
    }
}

