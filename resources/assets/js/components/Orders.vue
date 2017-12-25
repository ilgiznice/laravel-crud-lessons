<!-- 1) Вывести таблицу заказов (Готово) -->
<!-- 2) Перевести ID в текстовый вариант (Готово) -->
<!-- 3) Сделать удаление заказа (Готово) -->
<!-- 4) Сделать подтверждение заказа (Готово) -->
<!-- 5) Сделать фильтрацию по типу заказа (Готово) -->
<template>
    <div>
        <select v-model="status">
            <option value="">Все</option>
            <option
                    v-for="status in statuses"
                    v-bind:value="status.id"
            >
                {{ status.name }}
            </option>
        </select>
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
            <tbody v-for="order in ordersFiltered">
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
    </div>
</template>

<script>
    export default {
      data() {
        return {
          orders: [],
          statuses: [],
          status: '',
        };
      },
      computed: {
        ordersFiltered() {
          return this.orders.filter((order) => {
            if (this.status === '') return true;
            return this.status === order.status_id;
//            if (this.status === '') {
//              return true;
//            } else {
//              return this.status === order.status_id;
//            }
          });
        }
      },
      created() {
        //  Заказы
        this.$http
          .get('/admin/order')
          .then(function (response) {
            console.log(response);
            this.orders = response.body;
          });
        //  Статусы заказов
        this.$http
          .get('/admin/order/statuses')
          .then(function (response) {
            console.log(response);
            this.statuses = response.body;
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
                  // Заменяем исходный заказ на тот,
                  // который пришёл с бэка
                  _order = response.body;
                }
                return _order;
              })
            });
        }
      }
    }
</script>