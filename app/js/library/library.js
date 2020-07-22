
import Vue from 'vue';
import InputImage from './forms/InputImage';
import InputText from './forms/InputText';
import InputRequired from './forms/InputRequired';

const Components = {
	InputImage,
	InputText,
	InputRequired
};

Object.keys(Components).forEach( name => {
	Vue.component(name, Components[name]);
});