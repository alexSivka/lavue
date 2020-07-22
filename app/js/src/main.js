

import axios from 'axios';
window.axios = axios;

import utils from './Utils';
Vue.use(utils);


import Toasted from 'vue-toasted';
Vue.use(Toasted, {
	iconPack: 'fontawesome',
	duration: 2000,
	position: 'bottom-left'
});


import VueRouter from 'vue-router'
Vue.use(VueRouter);

const routes = [
	{ path: "*", component: App }
];

const router = new VueRouter({
	mode: 'history',
	routes
});

import Vuex from 'vuex';
Vue.use(Vuex);

import VueI18n from 'vue-i18n';

const i18n = new VueI18n({
	silentTranslationWarn: true
});

import externalComponent from './external-component';
import MainComponent from './MainComponent';

const store = new Vuex.Store({

	state: {
		locale: 'ru',
		pageTitle: 'Lavue cms',
		i18n: i18n,
		localePathArr: [],
		currentComponent: '',
		componentData: {},
		MainComponent: MainComponent
	},

	actions: {
		async lang({state}, path){
			path = path.replace(/(.*)\/$/, '$1') + '/' + state.locale + '.json';
			if(state.localePathArr.indexOf(path) != -1) return;
			let res = await axios.get(path);
			state.i18n.mergeLocaleMessage(state.locale, res.data);
			state.localePathArr.push(path);
		},
	},

	mutations: {
		setPageTitle(state, title){
			state.pageTitle = title;
		},

		setComponentData(state, data){
			state.componentData = data;
		},

		setCurrentComponent(state, payload){
			state.currentComponent = payload;
		}
	}
});

import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);


new Vue({

	router,
	store,
	i18n,

	el: '#app',

	components: {
		App
	},

	async created(){
		this.$i18n.locale = this.$store.state.locale;
		store.dispatch('lang', '/app/lang/').then( () => {
			this.$utils.setTranslitFromI18n(this.$i18n.getLocaleMessage(this.$store.state.locale));
		});
	},

	async mounted(){
		await this.setComponent();
		this.$router.afterEach( async (to) => {
			await this.setComponent();
		});
	},

	methods: {
		async setComponent(){
			let res = await axios.post(this.$router.currentRoute.fullPath);
			if(res.data.type == 'script') {
				this.$store.commit('setComponentData', res.data.data ? res.data.data : {});
				this.$store.commit('setCurrentComponent', () => externalComponent(res.data.src));
			}else{
				this.$store.commit('setCurrentComponent', '');
			}
		}
	}

});

