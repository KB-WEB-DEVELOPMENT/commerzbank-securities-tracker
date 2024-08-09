<template>
	<main>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Navbar</a>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<Link class="nav-link" href="/accounts">My security accounts</Link>
						</li>
					</ul>
				</div>
		</nav>
		<article>
			<div class="container">
				<slot />
			</div>
		</article>
		<footer>
			<div class="container">
				{{ $page.props.appName }}
			</div>
		</footer>
	</main>
</template>
<script>
	import { Link } from "@inertiajs/inertia-vue3";

	export default {
		components: {
			Link,
		},
	};
</script>
