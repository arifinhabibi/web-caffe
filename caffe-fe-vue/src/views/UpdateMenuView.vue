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
            
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Ubah Menu</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                   
                    <div class="card-body">
                      <form @submit.prevent="updateMenu(this.$route.params.id)">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Menu</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" v-model="update_menu" placeholder="Tuliskan nama menu disini" />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-company">Harga</label>
                          <div class="col-sm-3">
                            <input
                              type="number"
                              class="form-control"
                              id="basic-default-company"
                              placeholder="tulis harga disini"
                              v-model="update_price"
                            />
                          </div>
                          <div class="col-sm-7">
                            <h3>

                              {{ format_number.format(update_price) }}
                            </h3>
                          </div>
                        </div>
                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Link Image</label>
                          <div class="col-sm-10">
                            <textarea
                              id="basic-default-message"
                              class="form-control"
                              placeholder="paste link image disini"
                              aria-describedby="basic-icon-default-message2"
                              v-model="update_image"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
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
import NavbarComponent from '@/components/NavbarComponent'
import MenuNavigasiComponent from '@/components/MenuNavigasiComponent'
import FooterComponent from '@/components/FooterComponent.vue'
import axios from 'axios'
import Swal from 'sweetalert2'


   export default {
       name: 'UpdateMenuView',
       data() {
           return {
            format_number: new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }),
            update_menu: null,
            update_price: null,
            update_image: null
           }
       },
       components: {
        NavbarComponent, MenuNavigasiComponent, FooterComponent
       },
       methods: {
        updateMenu(id){
          axios.post(`http://127.0.0.1:8000/api/list-menu/update/${id}?token=${localStorage.getItem('token')}`, {
            menu: this.update_menu,
            price: this.update_price,
            image: this.update_image
          }).then(
            response => {
              Swal.fire({
                icon: 'success',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1000
              })
              setTimeout(() => {
                this.$router.push('/list-menu')
              }, 1000)
            }
          ).catch(
            err => {
              Swal.fire({
                icon: 'error',
                text: err.response.data.message,
              })
            }
          )
        },
          getMenu(id){
            console.log(id)
            axios.get(`http://127.0.0.1:8000/api/list-menu/update/${id}?token=${localStorage.getItem('token')}`).then(
              resp => {
                console.log(resp)
                this.update_menu = resp.data.menu
                this.update_price = resp.data.price
                this.update_image = resp.data.image
              }
            ).catch(
              // err => {
              //   Swal.fire({
              //     icon: 'error',
              //     title: err.response.data.message,
              //     showConfirmButton: false,
              //     timer: 1000
              //   })

              //   setTimeout(() => {
              //     this.$router.push('/list-menu')
              //   }, 1000)
              // }
            )
          }
       },
       mounted() {
        const token = localStorage.getItem('token')
        const id = this.$route.params.id
         
         if(token == null){
           this.$router.push('/login')
         } else {
          this.getMenu(id)
         }
       },
   }
</script>