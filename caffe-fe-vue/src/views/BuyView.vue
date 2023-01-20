<template>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        <!-- Menu -->
          <MenuNavigasiComponent />
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- navbar -->
          <NavbarComponent />

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                  <div class="card-body">


                  <div class="row justify-content-center">
                    <div class="col-md-7 mb-4">
                      
                      <div class="row">
                        <div class="col-md-3">
                          <h3 class="mb-0">List Menu</h3>
                        </div>
                        <div class="col-md-9">
                          <div class="navbar-nav align-items-center">
                          <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                              type="text"
                              class="form-control border-0 shadow-none"
                              placeholder="Cari sesuatu"
                              v-model="searchMenu"
                              />
                            </div>
                          </div>
                        </div>
                        {{ filteredList }}
                      <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                        <div class="col" v-for="data in datas" :key="data">
                          <div class="card h-100">
                            <div class="d-flex justify-content-center mt-2">
                              <img class="card-img-top" :src="data.image" style="width: 150px; height: 130px;"  />
                            </div>
                            <div class="card-body">
                              <h5 class="card-title mb-0">{{ data.menu }}</h5>
                              <span class="text-small">Harga : {{ format_number.format(data.price) }}</span>
                              <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-2" @click="order(data.menu, data.price)">pilih</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      
                    </div>
                    <div class="col-md-5">

                      
                      
                    <div class="bill-orders">

                      <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                          <h5 class="mb-0">Bill Pemesanan</h5>
                        </div>
                        <div class="card-body">
                          <form @submit.prevent="billOrder">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Nama Pemesan</label>
                              <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Tulis nama disini" v-model="buyer" required />
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-company">No Meja</label>
                              <input type="text" class="form-control" id="basic-default-company"
                              placeholder="Tulis no meja disini" v-model="no_table" required />
                            </div>
                            
                            <h6 class="mt-2 mb-0">List Pesanan</h6>
                            <table class="table table-responsive">
                              <div class="bg-danger text-white text-center p-3 mt-2" v-if="orders.length == 0">belum memilih menu</div>
                              <tr v-for="(order, index) in orders" :key="order" class="mt-1">
                                <td>{{ order.menu }}</td>
                                <td>{{ format_number.format(parseInt(order.price)) }}</td>
                                <td>
                                  <input type="number" min="1" value="1" class="form-control quantity" @change="quantityChange(index)" style="width: 80px;">
                                </td>
                                <td><i class='bx bx-trash-alt trash bg-danger text-white' @click="deleteOrder(index)"></i></td>
                              </tr>

                            </table>

                            <div class="row justify-content-center align-items-center mt-4">
                              <div class="col-6" v-if="orders.length != 0">
                                <p class="text-end">Total Harga :</p>
                              </div>
                              <div class="col-6" v-if="orders.length != 0">
                                <h5>{{ format_number.format(total_price.reduce((total, num) => parseInt(total) + parseInt(num), 0)) }}</h5>
                              </div>
                              <div class="col-12" v-if="orders.length != 0">
                                <h5 class="mb-0 mt-2">Pembayaran</h5>
                                <input type="number" class="form-control mt-2" min="1" v-model="cash" required>
                              </div>
                              
                                <div class="col-6 mt-3" v-if="orders.length != 0">
                                  <p class="text-end">Cash :</p>
                                </div>
                                  <div class="col-6 mt-3" v-if="orders.length != 0">
                                    <h5>{{ format_number.format(cash) }}</h5>
                                </div>

                            </div>
                            <div class="d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary mt-2" v-if="orders.length > 0">Pesan</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      </div>
                      </div>
                    </div>  
                  </div>
                </div>

              
            </div>
            <!-- / Content -->

            <!-- footer -->
            <FooterComponent />

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
</template>


<script>

import MenuNavigasiComponent from '@/components/MenuNavigasiComponent'
import NavbarComponent from '@/components/NavbarComponent'
import FooterComponent from '@/components/FooterComponent'
import  axios  from 'axios'
import Swal from 'sweetalert2'

    export default {
        name: 'BuyView',
        data() {
          return {
            searchMenu: '',
            datas: null,
            filter: ['americano', 'machiatto'],
            orders: [],
            total_price: [],
            format_number: new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }),
            data_empty: null,
            buyer: null,
            no_table: null,
            cash: null,
            quantity: []
          }
        },
        components: {
            MenuNavigasiComponent,
            FooterComponent,
            NavbarComponent,
        },
        methods: {
          order(menu, price){
            this.orders.push({menu: menu, price: price})
            this.total_price.push(price)
            this.quantity.push(1)
          },
          deleteOrder(index){
            this.orders.splice(index, 1)
            this.total_price.splice(index, 1)
          },
          listMenu(token){
            try {
              axios.get(`http://127.0.0.1:8000/api/orders?token=${token}`).then(
              response => {
                this.datas = response.data.menus
              }
            )
            } catch (error) {
              this.data_empty = error.response.data.message
            }
          },
          billOrder(){
            const total = this.total_price.reduce((total, num) => parseInt(total) + parseInt(num), 0)
            if (this.cash < total) {
              Swal.fire({
                icon: 'error',
                title: 'uang pembayaran kurang',
                showConfirmButton: false,
                timer: 1000
              })
            } else {
              var menu_orders = []
              this.orders.forEach((order, index) => {
                const menu = []
                menu.push(order.menu)
                menu.push(order.price)
                menu.push(this.quantity[index])
                menu_orders.push(menu)
              });

              axios.post(`http://127.0.0.1:8000/api/orders?token=${localStorage.getItem('token')}`, {
                buyer: this.buyer,
                no_table: this.no_table,
                total_payment: this.total_price.reduce((total, num) => parseInt(total) + parseInt(num), 0),
                cash: this.cash,
                menu_orders: menu_orders
              }).then(
                response => {
                  Swal.fire({
                    icon: 'success',
                    title: response.data.message,
                    text: 'kembalian: '+ (this.format_number.format(this.cash - this.total_price.reduce((total, num) => parseInt(total) + parseInt(num), 0))) ,
                  })
                }
                ).catch(
                  err => {
                  Swal.fire({
                    icon: 'error',
                    title: err.response.data.message,
                  })
                }
              )
            }
          },
          quantityChange(index){
            const domQuantity = document.querySelectorAll('.quantity')
            this.quantity.splice(index, 1)
            this.quantity.splice(index, 0, parseInt(domQuantity[index].value))

            // total price
            this.orders.forEach((order, indexOrder) => {
              if (indexOrder == index) {
                this.total_price.splice(index, 1)
                this.total_price.splice(index, 0, order.price * this.quantity[index])
              }
            })
          },
          
        },
        mounted() {
          const token = localStorage.getItem('token')

          if(token == null){
            this.$router.push('/login')
          } else {
            this.listMenu(token)
          }
        },
        computed: {
          filteredList() {
            return this.filter.filter(data => {
              return data.toLowerCase().includes(this.searchMenu.toLowerCase())
            })
          }
        }
        

    }
</script>