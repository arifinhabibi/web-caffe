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
                        <button class="btn btn-primary">+</button>
                    </div>
                </div>
              <div class="text-nowrap">
                <table class="table card-table ">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>menu</th>
                      <th>harga</th>
                      <th>aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <tr>
                      <td>1</td>
                      <td>
                        Ekspresso
                      </td>
                      <td>
                        {{ format_number.format(parseInt(20000)) }}                        
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
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
</template>


<script>
  
import MenuNavigasiComponent from '@/components/MenuNavigasiComponent'
import NavbarComponent from '@/components/NavbarComponent'
import FooterComponent from '@/components/FooterComponent'


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
    }
  }
}
</script>
