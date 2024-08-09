	
<template>

    <Head title="My Security Account - Portfolio Details" />

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
						
						<h5>Portfolio Details</h5>
						
						<p>Portfolio total value amount: {{ viewModel.portfolio.totalValue_amount }} {{ viewModel.portfolio.totalValue_currency }}</p>
						<p>Portfolio average payout per position: {{ viewModel.averagePayoutPerPosition }} (mix of currencies - see positions table below)</p>
						<p>Portfolio effective date: {{ viewModel.portfolio.effectiveDate }}</p>
						
						<br/>
						
						<h3>Portfolio positions - Summary</h3>						
						<div class="p-6 bg-white border-b border-gray-200 flex items-center space-x-4">
							<table class="min-w-full divide-y divide-gray-200">
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Payout ID
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Payout Amount
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Payout Currency
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Last Trade Date
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Position Details
										</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200 overflow-y-scroll">
									<tr v-for="item in viewModel.positionsCollection" :key="item.id" class="hover:bg-gray-100">
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{item.payoutId}}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{item.payout_amount}}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{item.payout_currency}}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{item.lastTradeDate}}</div>
										</td>
										<td class="px-6 py-4">
											<a :href="`/accounts/${viewModel.portfolio.securitiesAccountId}/portfolio/positions/${item.id}`">
												<button>
													Position Details
												</button>
											</a>
										</td>										
									</tr>
								</tbody>
							</table>
						</div>													
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
		positionsCollection: {
			type: Object,
			required: true,
		},
    }
}
</script>
