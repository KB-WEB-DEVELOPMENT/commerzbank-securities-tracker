<template>

    <Head title="Transaction Details" />

    <BreezeAuthenticatedLayout>
        <template #header>			
            <p>Customer Name: {{ viewModel.user.name }}</p>
            <p>Customer Email: {{ viewModel.user.email }}</p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-6 gap-4">
						
						<h3>Securities Account Id: {{ viewModel.securitiesAccountId }}</h3>
						
						<h5>Transaction Details</h5>
						
						<p>Accrued interest amount: {{ viewModel.transaction.accruedInterest_amount }} {{ viewModel.transaction.accruedInterest_currency }}</p>
						<p>General infos: {{ viewModel.transaction.blockInfo_blockText }}, to {{ viewModel.transaction.blockInfo_blockTo }}</p>
						<p>Booking date: {{ viewModel.transaction.bookingDate }}</p>
						<p>Transaction status: cancellationInfo_cancelledTransactionId' {{ viewModel.transaction }}</p>
						<p>Status: cancellationInfo_isCancelation' {{ viewModel.transaction }}</p>
						<p>Costs description: {{ viewModel.transaction.costs_costDescription }}</p>
						<p>Costs: {{ viewModel.transaction.costs_money_amount }} {{ viewModel.transaction.costs_money_currency }}</p>
						<p>Depository: {{ viewModel.transaction.depository }}</p>
						<p>Exchange rate: {{ viewModel.transaction.exchangeRate }}</p>
						<p>Price: {{ viewModel.transaction.price_amount }} {{ viewModel.transaction.price_unit }}</p>
						<p>ISIN: {{ viewModel.transaction.masterdata_isin }}</p>
						<p>WKN: {{ viewModel.transaction.masterdata_wkn }}</p>
						<p>Name: {{ viewModel.transaction.masterdata_name }}</p>
						<p>Notation Type: {{ viewModel.transaction.masterdata_notationType }}</p>
						<p>Size: {{ viewModel.transaction.size_amount }} {{ viewModel.transaction.size_unit }}</p>
						<p>Trading date: {{ viewModel.transaction.tradingDate }}</p>
						<p>Trading platform: {{ viewModel.transaction.tradingPlatform }}</p>
						<p>Transaction id: {{ viewModel.transaction.transactionId }}</p>
						<p>Transaction type id: {{ viewModel.transaction.transactionType_id }}</p>
						<p>Transaction type name: {{ viewModel.transaction.Type_name }}</p>
						<p>Valuta date: {{ viewModel.transaction.valutaDate }}</p>
						<p>Settlement account: {{ viewModel.transaction.accountsettlementAccount }}</p>
						<p>Settlement account Reference Description: {{ viewModel.transaction.settlementAccountRef_description }}</p>
						<p>Settlement account Reference IBAN: {{ viewModel.transaction.settlementAccountRef_iban }}</p>
						<p>Settlement account Reference currency: {{ viewModel.transaction.settlementAccountRef_currency }}</p>
						<p>Market value: {{ viewModel.transaction.marketValue_amount }} {{ viewModel.transaction.marketValue_currency }}</p>
						<p>Actual amount: actualAmount_amount' {{ viewModel.transaction.actualAmount_amount }} {{ viewModel.transaction.actualAmount_currency }}</p>
						<p>External order number: {{ viewModel.transaction.externalOrderNumber }}</p>
						<p>Settlement number: {{ viewModel.transaction.settlementNumber }}</p>
						<p>Execution number: {{ viewModel.transaction.executionNumber }}</p>
						<p>Client Order id: {{ viewModel.transaction.clientOrderId }}</p>
						<p>Transaction detailed type: {{ viewModel.transaction.transactionDetailedType }}</p>					
						<p>Tax type: {{ viewModel.transaction.taxes_taxType }}</p>
						<p>Tax type description: {{ viewModel.transaction.taxTypeDescription }}</p>
						<p>Tax amount: {{ viewModel.transaction.taxes_amount_amount }} {{ viewModel.transaction.taxes_amount_amount }}</p>	
                    					
					</div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        viewModel: {
            type: Object,
            required: true,
        },
		transaction: {
				type: Object,
				required: true,
			},
    }
}
</script>