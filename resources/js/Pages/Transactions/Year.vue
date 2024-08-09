<template>

    <Head title="My Security Account - Transactions" />

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
						
						<h5>Transactions Summary | From the last 365 days (1 year)</h5>

							<SortedTransactions />		
							
                    </div>
                </div>
            </div>
        </div>
    
	</BreezeAuthenticatedLayout>
	
</template>

<script>

	import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
	import SortedTransactions from '@/Components/Transaction/CurrentYearTransactions.vue'
	import { Head } from '@inertiajs/inertia-vue3';

	export default {
		components: {
			BreezeAuthenticatedLayout,
			Head,
			SortedTransactions,
		},
		props: {
			viewModel: {
				type: Object,
				required: true,
			},
		}
	}
	
</script>