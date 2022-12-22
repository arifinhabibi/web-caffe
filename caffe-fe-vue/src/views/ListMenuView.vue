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
                    <div class="col-md-8 mb-4">

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
                            />
                          </div>
                        </div>
                        </div>
                      <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                        <div class="col" v-for="data in datas" :key="data">
                          <div class="card h-100">
                            <div class="d-flex justify-content-center mt-2">
                              <img class="card-img-top w-px-100" :src="'@./../assets/img/elements/' + data.image"  />
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
                    <div class="col-md-4">

                      
                      
                    <div class="bill-orders">

                      <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                          <h5 class="mb-0">Bill Pemesanan</h5>
                        </div>
                        <div class="card-body">
                          <form>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Nama Pemesan</label>
                              <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Tulis nama disini" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-company">No Meja</label>
                              <input type="text" class="form-control" id="basic-default-company"
                                placeholder="Tulis no meja disini" />
                            </div>

                            <h6 class="mt-2 mb-0">List Pesanan</h6>
                            <table class="table table-responsive">
                              <tr v-for="(order, index) in orders" :key="order" class="mt-1">
                                <td>{{ order.menu }}</td>
                                <td>{{ format_number.format(parseInt(order.price)) }}</td>
                                <td><i class='bx bx-trash-alt trash bg-danger text-white' @click="deleteOrder(index)"></i></td>
                              </tr>

                              

                            </table>

                            <div class="row justify-content-center align-items-center mt-4">
                              <div class="col-6">
                                <p class="text-end">Total Harga :</p>
                              </div>
                              <div class="col-6">
                                <h5>{{ format_number.format(total_price.reduce((total, num) => parseInt(total) + parseInt(num), 0)) }}</h5>
                              </div>
                            </div>
                            <div class="d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary mt-2">Pesan</button>
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

    export default {
        name: 'LoginView',
        data() {
          return {
            datas: [
              {
                'menu': 'Americano',
                'price': '25000',
                'image': 'logo-coffe.png'
              },
              {
                'menu': 'Ekspresso',
                'price': '25000',
                'image': 'logo-coffe.png'
              },
              {
                'menu': 'Juice Orange',
                'price': '20000',
                'image': 'logo-coffe.png'
              },
              {
                'menu': 'Coffe Latte',
                'price': '25000',
                'image': 'logo-coffe.png'
              },
              {
                'menu': 'Potato Fried',
                'price': '20000',
                'image': 'makanan.png'
              },
              {
                'menu': 'Fried Rice',
                'price': '15000',
                'image': 'makanan.png'
              }
            ],
            orders: [],
            total_price: [],
            format_number: new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            })
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
            console.log(this.orders)
          },
          deleteOrder(index){
            this.orders.splice(index, 1)
            this.total_price.splice(index, 1)
          }
        },
        mounted() {
          console.log(this.datas)
        },

    }
</script>