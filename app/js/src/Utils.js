


export default {

	install(Vue, options = {}){

		Vue.prototype.$utils = class {

			static toFormData(...args){
				const form = new FormData();
				for(let arg of args){
					if(typeof arg == 'object'){
						for(let [key, val] of Object.entries(arg)) form.append(key, val);
					}
				}
				return form;
			}

			static flatSelect(items, divider = ' / ', idKey = 'id', nameKey = 'name', parent = null) {
				let final = [];
				items.forEach( item => {
					if(parent) item[nameKey] = parent[nameKey] + ' / ' + item[nameKey];
					final.push({id: item[idKey], name: item[nameKey]});
					if (item.children && item.children.length) final = final.concat(this.flat(item.children, divider, idKey, nameKey, item));
				});
				return final;
			}


			static normalizeErrors(errors){
				let out = {};
				Object.entries(errors).reduce( (acc, item) => acc[ item[0] ] = item[1].join(', '), out);
				return out;
			}

			static jsonDecode(data){
				if(typeof data == 'object') return data;

				if(!data.indexOf('{') || !data.indexOf('[')){

					try{
						return JSON.parse(data);
					}catch(e){}

				}

				return data;
			}

			static transliterate(text){

				let translit = this.getTranslit();
				if(!translit) return text.toLowerCase();

				let arr = text.toLowerCase().split('');
				let out = [];

				for (let letter of arr ){
					if(letter.match(/[_]/)) out.push(letter);
					else out.push(typeof translit[letter] != 'undefined' ? translit[letter] : letter);
				}

				return out.join('').replace(/[-]+/g, '-').replace(/^[-]+(.*)/, '$1').replace(/^(.*)[-]+$/, '$1');
			}

			static setTranslitFromI18n(messages){
				this.translit = messages.translit ? messages.translit : null;
			}

			static getTranslit(){
				return this.translit ? this.translit : null;
			}
		};

		Vue.prototype.$utils.translit = {};


		Vue.prototype.$eventBus = new Vue();


	}

}