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
        components: {
            MenuNavigasiComponent,
            FooterComponent,
            NavbarComponent,
        }
    }
</script>