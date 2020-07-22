<template>
    <form @submit.prevent="save" novalidate>
        <div class="row">
            <div class="col-8 border-right">

                <InputRequired :label="$t('Header')" :name="`name`" :item="item" :errors="errors" @input="setAlias"></InputRequired>

                <InputRequired :label="$t('Alias')" :name="`alias`" :item="item" :errors="errors"></InputRequired>

                <select v-model="item.parent_id">

                </select>

                <div class="form-group">
                    <label>{{$t('Text')}}</label>
                    <textarea class="form-control" v-model="item.text"></textarea>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" v-model="item.active">
                    <label class="form-check-label">{{$t('module-page.Active')}}</label>
                </div>


            </div>

            <div class="col-4">
                <div>
                    <InputImage
                            :src="imgSrc"
                            :imgHeight="`250px`"
                            :imgWidth="`250px`"
                            :label="imgLabel"
                            @change="setFile"
                    ></InputImage>
                </div>
            </div>
        </div>

        <div class="clearfix mt-3">
            <button type="submit" class="btn btn-primary" :disabled="isSaving">{{$t('Save')}}</button>
        </div>

    </form>
</template>


<script>

    export default {

		props: ['data'],

    	data(){
    		return {
    			item: {},
                errors: {},
                aliasWasEntered: false,
                isSaving: false,
                imgLabel: '',
                imgFile: '',
                parents: []
            }
        },

        computed:{
			imgSrc(){
				return this.item.image ? '/assets/pages/' + this.item.image : '';
            }
        },

        created() {
			this.item = this.data.item;
			this.$store.dispatch('lang', '/app/Modules/Page/lang/').then(() => {
				if(this.item.id) this.$store.commit('setPageTitle', this.$t('module-page.Edit page'));
                else this.$store.commit('setPageTitle', this.$t('module-page.New page'));
            });
		},

        async mounted(){
            let res = await axios.post('/admin/modules/page/getParents/');
            this.parents = this.$utils.flatSelect(res.data.parents);
        },

        methods: {

			setFile(file){
				this.imgLabel = file.name;
				this.imgFile = file;
            },

			async save(){

				this.$el.classList.add('was-validated');
				if (this.$el.checkValidity() === false) return;

				this.errors = {};
				this.isSaving = true;

				let response;
				response = await axios.post('/admin/modules/page/save/', this.$utils.toFormData({...this.item, file: this.imgFile}))
                    .catch( res => response = res.response);

				this.isSaving = false;

				if(!this.hasErrors(response)){
					this.$toasted.success(this.$t('Saved'), { icon: 'check' });
					if(response.data.item && !this.item.id) this.$router.push({path: '/admin/modules/page/edit/?id=' + response.data.item.id});
					this.item.image = response.data.item.image;
                }

            },

            setAlias(){
				if(!this.item.id && !this.aliasWasEntered) this.item.alias = this.$utils.transliterate(this.item.name);
            },

			hasErrors(response){
				if(response.status == 422 && typeof response.data == 'object' && response.data.errors) {
					this.errors = this.$utils.normalizeErrors(response.data.errors);
					this.$el.classList.remove('was-validated');
					this.$toasted.error(this.$t('Error'), { icon : 'exclamation-triangle' });
					return true;
				}
			},

			getError(key){
				return typeof this.errors[key] != 'undefined' ? this.errors[key] : false;
			},


        },



	}
</script>