<template>
    <div class="form-group">
        <label>{{label}}</label>
        <input class="form-control" v-model="item[name]" :class="{'is-invalid': getError(name)}" @input="$emit('input', item[name])" required>
        <div class="invalid-feedback" v-show="!getError(name)">{{$t('errors.required')}}</div>
        <div class="invalid-feedback" v-show="getError(name)">{{getError(name)}}</div>
    </div>
</template>

<script>
    export default {
    	props: ['item', 'label', 'name', 'errors'],

        methods:{
			getError(key){
				return typeof this.errors[key] != 'undefined' ? this.errors[key] : false;
			}
        }
    }
</script>