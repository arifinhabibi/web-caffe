<template>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
        <router-link to="/" class="app-brand-link">
            <span class="app-brand-logo demo">
            <img src="../../public/assets/img/elements/logo-coffe.png" style="width: 30px;" alt="">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Cashier Caffe</span>
        </router-link>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <router-link to="/" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
            </router-link>
        </li>
        
        <li class="menu-item">
            <router-link to="/list-menu" class="menu-link">
            <i class='menu-icon bx bx-food-menu'></i>
            <div data-i18n="Analytics">List Menu</div>
            </router-link>
        </li>
        
        </ul>
    </aside>
</template>

<script>
    export default {
        name: 'MenuNavigasiComponent'
    }
</script>