<template>
	<div class="container-fluid h-100">
		<div class="row h-100">
			<div class="col sidebar-wrap">
				<Sidebar></Sidebar>
			</div>
			<div class="col main-wrap">
				<Top></Top>
				<div class="main">
					<div class="main-head">{{$store.state.pageTitle}}</div>
					<div class="content">
						<component :is="$store.state.MainComponent"></component>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

	import Top from './components/Top';
	import Sidebar from './components/Sidebar';

	export default {
		components: {
			Top,
			Sidebar
		}
	}
</script>