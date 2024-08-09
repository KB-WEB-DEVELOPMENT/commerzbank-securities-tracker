<template>

    <Head title="My Security Account - Transactions Summary" />

    <BreezeAuthenticatedLayout>
        <template #header>			
            <p>Customer Name: {{ viewModel.user.name }}</p>
            <p>Customer Email: {{ viewModel.user.email }}</p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-6 gap-4">
					
						<h3>Transactions</h3>
						
						<p>Securities Account Id: {{ viewModel.securitiesAccountId }}</p>
						
						<br/>
						
						<h5>Transactions Summary</h5>
						
						<h6>Sort Transactions: 
							<span><a :href='`/accounts/${viewModel.securitiesAccountId}/transactions/accrued-interest-desc`'>by accrued interest </a></span>
							<span><a :href='`/accounts/${viewModel.securitiesAccountId}/transactions/type-count-desc`'>by transaction type </a></span>
							<span><a :href='`/accounts/${viewModel.securitiesAccountId}/transactions/week`'>this week </a></span>
							<span><a :href='`/accounts/${viewModel.securitiesAccountId}/transactions/month`'>this month </a></span>
							<span><a :href='`/accounts/${viewModel.securitiesAccountId}/transactions/year`'>this year </a></span>
						</h6>

						<div class="p-6 bg-white border-b border-gray-200 flex items-center space-x-4">
							<table class="min-w-full divide-y divide-gray-200">
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Booking Date
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Accrued interest amount
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Accrued interest currency
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Depository
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Transaction Type
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Size Amount
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Size Unit
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											Transaction Details
										</th>										
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200 overflow-y-scroll">
									<tr v-for="item in viewModel.transactionsCollection" :key="item.id" class="hover:bg-gray-100">
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{ item.bookingDate }}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{ item.accruedInterest_amount }}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{ item.accruedInterest_currency }}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{ item.depository }}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{ item.transactionType_name }}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{ item.size_amount }}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900">{{ item.size_unit }}</div>
										</td>
										<td class="px-6 py-4">
											<a :href="`/accounts/${viewModel.securitiesAccountId}/transactions/${item.id}`">
												<button>
													Transaction Details
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
		transactionsCollection: {
			type: Object,
			required: true,
		},
    }
}
</script>