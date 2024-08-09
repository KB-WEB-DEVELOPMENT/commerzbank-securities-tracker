<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
    
		<template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        
		<div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<span>Welcome, {{ viewModel.user.name }},</span>
					<br/>
					<span>Access your security accounts ids: <a :href="accounts">here</a></span>
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
		},
	}

</script>
