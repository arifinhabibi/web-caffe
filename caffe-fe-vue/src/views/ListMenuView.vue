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
                
              <!-- Table within card -->
              <div class="row mb-4">
                    <div class="col-2">
                        <h5 class="mb-4">List Menu</h5>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          +
                        </button>
                    </div>
                </div>
              <div class="text-nowrap">
                <table class="table card-table ">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>menu</th>
                      <th>harga</th>
                      <th>image</th>
                      <th>aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <tr v-for="(data, index) in datas" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>
                        {{ data.menu }}
                      </td>
                      <td>
                        {{ format_number.format(parseInt(data.price)) }}                        
                      </td>
                      <td>
                        <img :src="data.image" style="width: 50px; height: 50px;" alt="">                    
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <router-link :to="'/ubah-menu/'+data.id" class="dropdown-item"><i class="bx bx-edit-alt me-1"></i> Edit</router-link>
                            <a class="dropdown-item" href="javascript:void(0);" @click="deleteMenu(data.id)"
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

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <h4>Menambahkan Menu</h4>
                    <form class="row g-3" @submit.prevent="addMenu">
                      <div class="col-md-6">
                        <label for="menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" v-model="name_menu" id="menu" required>
                      </div>
                      <div class="col-md-6">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" min="1" class="form-control" v-model="price_menu" id="price" required>
                      </div>
                      <div class="col-12">
                        <label for="image" class="form-label">link image</label>
                        <textarea rows="5" cols="5" class="form-control" v-model="image_menu"></textarea>
                      </div>
                      <div class="col-12">
                        <div class="row justify-content-center">
                          <div class="col-6">
                            <div class="d-flex">
                              <p class="me-3">Nama Menu :</p><h5>{{ name_menu }}</h5>
                            </div>
                            <div class="d-flex">
                              <p class="me-3">Harga Menu :</p><h5>{{ format_number.format(price_menu) }}</h5>
                            </div> 
                            <div class="d-flex">
                              <p class="me-3">Image Menu :</p><img v-if="image_menu != null" :src="image_menu" style="width: 50px; height: 50px;" alt="">
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div class="col-12">
                        <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">tambahkan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

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
import axios from 'axios'
import Swal from 'sweetalert2'


export default {
  name: 'ListMenuView',
  components: {
    MenuNavigasiComponent,
    NavbarComponent,
    FooterComponent
  },
  data(){
    return {
      format_number: new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
      }),
      datas: null,
      data_empty: null,
      name_menu: null,
      price_menu: null,
      image_menu: null,
    }
  },
  methods: {
    listMenu(token){
      axios.get(`http://127.0.0.1:8000/api/orders?token=${token}`).then(
        response => {
          this.datas = response.data.menus
        }
      ).catch(
        err => {
          this.data_empty = err.response.data.message
        }
      )
    },
    addMenu(){
      axios.post(`http://127.0.0.1:8000/api/list-menu?token=${localStorage.getItem('token')}`, {
        menu: this.name_menu,
        price: this.price_menu,
        image: this.image_menu
      }).then(
        response => {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.data.message,
            showConfirmButton: false,
            timer: 1000
          })

          setTimeout(() => {
            location.reload()
          }, 1000)
        }
      ).catch(
        err => {
          console.log(err)
          Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: err.response.data.message
          })
        }
      )
    },
    deleteMenu(id){
      axios.get(`http://127.0.0.1:8000/api/list-menu/delete/${id}?token=${localStorage.getItem('token')}`).then(
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
      this.listMenu(token)
    }
  },
}
</script>
