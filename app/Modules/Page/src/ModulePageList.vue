<template>
    <div>
        page list<br>
        <router-link to="/admin/modules/page/edit/">{{$t('new page')}}</router-link>
    </div>
</template>

<script>
    export default {

    	props: ['data'],

    	data(){
    		return {
    			items: []
            }
        },

    	created(){
    		this.$store.dispatch('lang', '/app/Modules/Page/lang/').then(() => {
				this.$store.commit('setPageTitle', this.$t('module-page.Pages'));
            });
        },

    	async mounted() {
    		//console.log(this.data);
            //await axios.post('/admin/module/page/getList/')
		}
	}
</script>