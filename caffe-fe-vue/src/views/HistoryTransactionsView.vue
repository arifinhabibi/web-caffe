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
                    <div class="col-4">
                        <h5 class="mb-4">Riwayat Transaksi {{ month }}</h5> 
                    </div>
                    <div class="col-auto">
                      <div class="d-flex justify-content-end">
                        <RouterLink to="/unduh-pdf-history" class="btn btn-primary" >print pdf</RouterLink>
                      </div>
                    </div>
                </div>
              <div class="table-responsive text-nowrap">
                <table class="table card-table ">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>no order</th>
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
                      <td v-if="data.month == month">
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" @click="deleteHistory(data.id)" href="javascript:void(0);"
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
import Swal from 'sweetalert2'

    export default {
        name: 'HistoryTransactionsView',
        components: {
            MenuNavigasiComponent,
            FooterComponent,
            NavbarComponent,
        },
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
              }
            ).catch(
              err => {
                console.log(err)
              }
            )
          },
          deleteHistory(id){
            axios.get(`http://127.0.0.1:8000/api/history/delete/${id}?token=${localStorage.getItem('token')}`).then(
              response => {
                Swal.fire({
                  icon: 'success',
                  title: response.data.message,
                  showConfirmButton: false,
                  timer: 1000
                })
                setTimeout(() => {
                  location.reload()
                }, 1000)
              }
            ).catch(
              err => {
                Swal.fire({
                  icon: 'error',
                  title: err.response.data.message
                })
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