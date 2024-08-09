<?php

namespace App\Enums;

enum TransactionTypeName: string
{
	case PURCHASE = 'purchase';
	case SALE = 'sale';
	case DELIVERY = 'delivery';
	case DEPOSIT = 'deposit';
	case MATURITY = 'maturity';
}
