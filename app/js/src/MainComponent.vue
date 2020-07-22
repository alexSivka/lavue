<template>
    <component v-if="$store.state.currentComponent" :is="$store.state.currentComponent" :data="$store.state.componentData"></component>
</template>