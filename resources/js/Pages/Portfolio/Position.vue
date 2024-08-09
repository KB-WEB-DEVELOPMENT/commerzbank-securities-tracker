	
<template>

    <Head title="Portfolio Position Details" />

    <BreezeAuthenticatedLayout>
        <template #header>			
            <p>Customer Name: {{ viewModel.user.name }}</p>
            <p>Customer Email: {{ viewModel.user.email }}</p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-6 gap-4">
					
						<h3>Securities Account Id: {{ viewModel.portfolio.securitiesAccountId }}</h3>
						
						<h5>Portfolio Position Details</h5>

						<p>Accrued interest: {{ viewModel.position.accruedInterest_amount }} {{ viewModel.position.accruedInterest_currency }}</p>
						<p>Current price: {{ viewModel.position.currentPrice_amount }} {{ viewModel.position.currentPrice_unit }}</p>
						<p>Exchange rate: {{ viewModel.position.exchangeRate }}</p>
						<p>Exchange rate date: {{ viewModel.position.exchangeRateDate }}</p>
						<p>Quote date: {{ viewModel.position.quoteDate }}</p>
						<p>Initial price: {{ viewModel.position.initialPrice_amount }} {{ viewModel.position.initialPrice_unit }}</p>
						<p>Initial exchange rate: {{ viewModel.position.initialExchangeRate }}</p>
						<p>Last trade date: {{ viewModel.position.lastTradeDate }}</p>
						<p>Payed accrued interest: {{ viewModel.position.payedAccruedInterest_amount }} {{ viewModel.position.payedAccruedInterest_currency }}</p>		 
						<p>Payout amount: {{ viewModel.position.payout_amount }} {{ viewModel.position.payout_currency }}</p>
						<p>Payout id: {{ viewModel.position.payoutId }}</p>
						<p>Quantity amount: {{ viewModel.position.quantity_amount }} {{ viewModel.position.quantity_unit }}</p>
						<p>Position ISIN: {{ viewModel.position.masterdata_position_isin }}</p>
						<p>Position WKN: {{ viewModel.position.masterdata_position_wkn }}</p>
						<p>Position name: {{ viewModel.position.masterdata_position_name }}</p>
						<p>Position notation type: {{ viewModel.position.masterdata_position_notationType }}</p>
						<p>Currency: {{ viewModel.position.masterdata_currency }}</p> 
						<p>Maturity Date: {{ viewModel.position.masterdata_maturityDate }}</p>
						<p>Vote: {{ viewModel.position.masterdata_vote }}</p>
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
    }
	}
	
</script>