<template>
  <div>
    <!-- header -->
    <header id="header">
      <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container han-rm han-width-full">
          <a class="navbar-brand" href="#" id="header-logo">
            <img
              src="assets/img/nicepay_logo.jpg"
              alt="nicepay_logo"
              class="img-fluid"
              style="width: 45px; height:auto"
            />
          </a>
          <a class="navbar-brand">NICEPAY PAYMENTS DEMO</a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto text-center">
              <router-link :to="{ name:'checkout' }" active-class="active">
                <a class="nav-link text-dark" id="checkout" active>CHECKOUT</a>
              </router-link>

              <router-link :to="{ name:'inquiry' }" exact-active-class="exact-active">
                <a class="nav-link text-dark" id="checkStatus">CHECK STATUS</a>
              </router-link>

              <router-link :to="{ name:'cancel' }" exact-active-class="exact-active">
                <a class="nav-link text-dark" id="cancel">CANCEL</a>
              </router-link>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  </div>
</template>

<script>
export default {
  created() {
    linkActiveClass: "is-active";
  }
};
</script>