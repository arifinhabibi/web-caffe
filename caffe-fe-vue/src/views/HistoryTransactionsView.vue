<template>
    <div>
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
                <!-- Table within card -->
                <div class="row mb-4">
                    <div class="col-2">
                        <h5 class="mb-4">Riwayat Transaksi</h5>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" >print pdf</button>
                    </div>
                </div>
              <div class="table-responsive text-nowrap">
                <table class="table card-table ">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pelanggan</th>
                      <th>no meja</th>
                      <th>List Pembelian</th>
                      <th>total</th>
                      <th>uang pembayaran</th>
                      <th>Tanggal Pembelian</th>
                      <th>aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <tr v-for="(data, index) in datas" :key="data">
                      <td>{{ index + 1 }}</td>
                      <td>{{ data.buyer }}</td>
                      <td>{{ data.no_table }}</td>
                      <td>
                        <div v-for="(data_menu, index) in data.menu_orders" :key="data_menu" class="d-flex">
                          {{ data_menu.menu }}{{ index + 1 == data.menu_orders.length ? '.' : ','  }}
                        </div>
                      </td>
                      <td>{{ data.total_payment }}</td>
                      <td>{{ data.cash }}</td>
                      <td>
                        {{ data.date_order }}
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"
                              ><i class="bx bx-info-circle me-1"></i> Detail</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                              ><i class="bx bx-edit-alt me-1"></i> Edit</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                              ><i class="bx bx-trash me-1"></i> Delete</a
                            >
                          </div>
                        </div>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!--/ Table within card -->

              
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
    </div>
</template>



<script>

import MenuNavigasiComponent from '@/components/MenuNavigasiComponent'
import NavbarComponent from '@/components/NavbarComponent'
import FooterComponent from '@/components/FooterComponent'
import axios from 'axios'

    export default {
        name: 'HistoryTransactionsView',
        components: {
            MenuNavigasiComponent,
            FooterComponent,
            NavbarComponent,
        },
        data() {
          return {
            datas: null
          }
        },
        methods: {
          history(){
            axios.get(`http://127.0.0.1:8000/api/history?token=${localStorage.getItem('token')}`).then(
              response => {
                console.log(response)
                this.datas = response.data
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