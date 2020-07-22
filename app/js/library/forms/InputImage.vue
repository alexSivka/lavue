<template>
    <div>
        <div class="img-thumbnail" :style="{width: imgWidth, height: imgHeight}">
            <img v-if="src"
                 :src="src"
                 onerror="this.src = '/app/assets/images/noimg.jpg'"
            >
        </div>
        <div class="custom-file mt-3">
            <input type="file" class="custom-file-input" @change="change" :multiple="multiple">
            <label class="custom-file-label" :data-text="$t('Choose file')">{{label}}</label>
        </div>
    </div>
</template>



<script>
    export default {

    	props: {
			src: {
				default: ''
			},
    		label: {
    			default: ''
            },
            multiple: {
    			default: false
            },
            image: {
    			default: ''
            },
            imgWidth: {
    			default: '100%'
            },
            imgHeight: {
    			default: '100%'
            },
        },

    	data(){
    	    return {
    	    	input: ''
            }
        },

        mounted(){
    	    this.input = this.$el.querySelector('.custom-file-input');
        },

    	methods: {
    		change(){
    			if(this.multiple) this.$emit('change', this.input.files);
    			else this.$emit('change', this.input.files[0]);

            }
        }
    }
</script>


<style scoped>
    .img-thumbnail img {
        max-width: 100%;
    }
    .custom-file-label::after {
        content: attr(data-text) !important;
    }
</style>