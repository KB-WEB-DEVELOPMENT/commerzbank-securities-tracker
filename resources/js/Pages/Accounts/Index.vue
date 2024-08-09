<template>

    <Head title="My Security Accounts" />

    <BreezeAuthenticatedLayout>
        <template #header>			
            <p>Customer Name: {{ viewModel.user.name }}</p>
            <p>Customer Email: {{ viewModel.user.name }}</p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-6 gap-4">
						<p>Access your portfolio for each of your security acccounts:</p>
						<ul>
							<div v-for="item in viewModel.accountsCollection" 
								:key="item.id" 
								class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md hover:bg-gray-100 cursor-pointer">
								<div class="text-xl font-medium text-black">
									<li>
										<a :href="`/accounts/${item.securityAccountId}/portfolio`">
											{{ item.securityAccountId }}
										</a>
									</li>
								</div>
							</div>
						</ul>
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
			accountsCollection: {
				type: Object,
				required: true,
			},
		}
	}
</script>
