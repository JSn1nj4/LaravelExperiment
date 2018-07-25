
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

let ToggleButton = {
    props: ['clickHandler'],
    methods: {
        toggle() {
            this.clickHandler();
        }
    }
};

let HeaderMenu = {
    data() {
        return {
            visible: false,
            opacity: '',
            zIndex: '',
            toggleDelay: 300
        };
    },

    methods: {
        toggleMenu() {
            this.visible = !this.visible;

            if(this.visible) {

                this.zIndex = 50;
                setTimeout(() => {
                    this.opacity = 1;
                }, this.toggleDelay);

            } else {

                this.opacity = '';
                setTimeout(() => {
                    this.zIndex = '';
                }, this.toggleDelay);

            }
        }
    },

    created() {
        this.$root.$on('menu-toggled', this.toggleMenu);
    }
};

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
