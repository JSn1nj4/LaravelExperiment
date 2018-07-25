
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

import { ToggleButton } from './components/Button';
import { HeaderMenu } from './components/HeaderMenu';

const header = new Vue({
    el: '#header',
    components: {
        'toggle-button': ToggleButton,
        'header-menu': HeaderMenu
    },
    methods: {
        buttonClick() {
            this.$emit('menu-toggled');
        }
    }
});
