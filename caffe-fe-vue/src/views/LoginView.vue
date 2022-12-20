<template>
    <div>
        <!-- content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <router-link to="/" class="app-brand-link gap-2">
                  <img src="../../public/assets/img/elements/logo-coffe.png" style="width: 40px;" alt="">
                  <span class="app-brand-text demo text-body fw-bolder">Cashier Caffe</span>
                </router-link>
              </div>
              <!-- /Logo -->
              

              <form id="formAuthentication" class="mb-3">
                <div class="mb-3">
                  <label for="email" class="form-label">Nama Pengguna</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email-username"
                    placeholder="Tulis nama pengguna disini"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Kata Sandi</label>
                    
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                </div>
              </form>

              <p class="text-center">
                <a href="">
                    <span>Lupa kata sandi?</span>
                </a>
               
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
    </div>
</template>


<script>
    export default {
        name: 'LoginView'
    }
</script>