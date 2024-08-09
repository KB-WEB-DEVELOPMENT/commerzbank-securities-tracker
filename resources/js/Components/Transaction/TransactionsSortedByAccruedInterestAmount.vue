<template>
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
				<tr v-for="item in sortTransactionsByAccruedInterestAmountDesc" :key="item.id" class="hover:bg-gray-100">
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
						<a href="'/accounts/' + item.account_id + '/transactions/' + item.id">
							<button>Transaction Details</button>
						</a>
					</td>										
				</tr>
			</tbody>
		</table>
	</div>													
</template>

<script>
	export default {
		props: {
			sortTransactionsByAccruedInterestAmountDesc: {
				type: Object,
				required: true,
			},
		}
	}
</script>