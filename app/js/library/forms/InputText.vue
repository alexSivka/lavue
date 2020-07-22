<template>
    <div class="form-group">
        <label>{{label}}</label>
        <input class="form-control" v-model="item[name]" @input="$emit('input', item[name])">
    </div>
</template>

<script>
	export default {
		props: ['item', 'label', 'name']
	}
</script>