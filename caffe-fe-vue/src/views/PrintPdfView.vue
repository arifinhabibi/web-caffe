<template>
    <div class="mt-5 text-nowrap">
                <table class="table card-table ">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Order</th>
                      <th>Nama Pelanggan</th>
                      <th>no meja</th>
                      <th>List Pembelian</th>
                      <th>total</th>
                      <th>uang pembayaran</th>
                      <th>Tanggal Pembelian</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <tr v-for="(data, index) in datas_history" :key="data">
                      <td v-if="data.month == month">{{ index + 1 }}</td>
                      <td v-if="data.month == month">{{ data.no_order }}</td>
                      <td v-if="data.month == month">{{ data.buyer }}</td>
                      <td v-if="data.month == month">{{ data.no_table }}</td>
                      <td v-if="data.month == month">
                        <div v-for="(data_menu, index) in data.menu_orders" :key="data_menu" class="d-flex">
                          {{ data_menu.menu }}({{ data_menu.quantity }}){{ index + 1 == data.menu_orders.length ? '.' : ','  }}
                        </div>
                      </td>
                      <td v-if="data.month == month">{{  format_number.format(data.total_payment) }}</td>
                      <td v-if="data.month == month">{{ format_number.format(data.cash)  }}</td>
                      <td v-if="data.month == month">
                        {{ data.date_order }}
                      </td>
                     
                    </tr>
                    
                  </tbody>
                </table>
              </div>

</template>

<script>
import axios from 'axios'

    export default {
        name: 'PrintPdfView',
        data() {
          return {
            datas_history: [],
            month: null,
            format_number: new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            })
          }
        },
        methods: {
          history(){
            axios.get(`http://127.0.0.1:8000/api/history?token=${localStorage.getItem('token')}`).then(
              response => {
                this.datas_history = response.data.history_bills
            
                this.month = response.data.month

                setTimeout(() => {
                    window.print()
                }, 100)

              }
            ).catch(
              err => {
                console.log(err)
              }
            )
          }
        },
        mounted() {
          const token = localStorage.getItem('token')
          
          if(token == null){
              this.$router.push('/login')
            } else {
                this.history()
            }
        },
    }
</script>