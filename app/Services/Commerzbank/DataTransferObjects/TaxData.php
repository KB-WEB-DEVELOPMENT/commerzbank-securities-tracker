<?php
 
namespace App\Services\Commerzbank\DataTransferObjects;

use Spatie\LaravelData\Data;

class TaxData extends Data 
{					
	public function __construct(
		private readonly string $taxType,
		private readonly string $taxTypeDescription_de,
		private readonly string $taxTypeDescription_en,
		#[Min(0)]
		private readonly float  $amount_amount,
		private readonly string $amount_currency,
    ) {}
}