<!-- 1) Вывести таблицу заказов (Готово) -->
<!-- 2) Перевести ID в текстовый вариант (Готово) -->
<!-- 3) Сделать удаление заказа -->
<!-- 4) Сделать подтверждение заказа -->
<!-- 5) Сделать фильтрацию по типу заказ -->
<template>
    <table class="table">
        <thead>
            <tr>
                <td>Имя</td>
                <td>Телефон</td>
                <td>E-mail</td>
                <td>Адрес</td>
                <td>Название товара</td>
                <td>Статус заказа</td>
                <td colspan="2"></td>
            </tr>
        </thead>
        <tbody v-for="order in orders">
            <tr>
                <td>{{ order.name }}</td>
                <td>{{ order.phone }}</td>
                <td>{{ order.email }}</td>
                <td>{{ order.address }}</td>
                <td>{{ order.productName }}</td>
                <td>{{ order.status }}</td>
                <td>
                    <button v-on:click="deleteOrder(order)">
                        Удалить
                    </button>
                </td>
                <td>
                    <button v-on:click="confirm(order)">
                        Начать обработку заказа
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
      data() {
        return {
          orders: [],
        };
      },
      created() {
        this.$http
          .get('/admin/order')
          .then(function (response) {
            console.log(response);
            this.orders = response.body;
          });
      },
      methods: {
        deleteOrder(order) {
          this.$http
            .delete(`/admin/order/${order.id}`, { headers: { 'X-CSRF-TOKEN': window.Laravel.csrf } })
            .then(function (response) {
              console.log(response);
              this.orders = this.orders.filter(function (_order) {
                //  Все, кроме удалённого заказа
                return _order.id !== order.id;
              });
            });
        },
        confirm(order) {
          this.$http
            .post(`/admin/order/${order.id}/proceed`, {}, { headers: { 'X-CSRF-TOKEN': window.Laravel.csrf } })
            .then(function (response) {
              console.log(response);
              this.orders = this.orders.map(function (_order) {
                if (_order.id === order.id) {
                  _order = response.body;
                }
                return _order;
              })
            });
        }
      }
    }
</script>