require('./bootstrap');

window.Vue = require('vue');

Vue.component('article-component', require('./components/Article.vue').default);

const app = new Vue({
    el: '#app',
});
