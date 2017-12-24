// require('./bootstrap');

window.Vue = require('vue');

require('vue-resource');

new Vue({
  el: '#app',
  data: {
        products: [],
  },
  created() {
    this.$http.get('/admin/product')
      .then(function (response) {
        console.log(response);
        this.products = response.body;
      });
  },
  methods: {
    createOrder(product) {
      this.$http
        .post('/admin/order', {
          ...product.order,
          product_id: product.id
        }, {
          headers: { 'X-CSRF-TOKEN': window.Laravel.csrf }
        })
        .then(function (response) {
          console.log(response);
        }, function (err) {
          console.log(err);
        });

      //  'a' + 'b' => 'ab'
      //  'a' . 'b' => 'ab'
      //  array_concat([1, 2], [3, 4]) => [1, 2, 3, 4]
      //  [1, 2].concat([3, 4]) => [1, 2, 3, 4]
      //  [...[1, 2], ...[3, 4]] => [1, 2, 3, 4] ES6
      //  { id: product.id, name: product.order.name }
      //  Object.assign({}, product.order, { id: product.id })
      //  => { id: product.id, name: product.order.name, ... }
      //  { ...product.order, id: product.id }
      //  => { id: product.id, name: product.order.name, ... }
    }
  }
});

Vue.component('orders', require('./components/Orders.vue'));

// <orders></orders>

new Vue({
  el: '#orders',
});


