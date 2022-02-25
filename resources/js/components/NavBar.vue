<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <router-link to="/" class="navbar-brand">Login Temperatures</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto"></ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <!-- Authentication Links -->

          <li class="nav-item">
            <router-link to="/login" class="nav-link" v-if="!authenticated"
              >Login</router-link
            >
          </li>

          <li class="nav-item" v-if="!authenticated">
            <router-link to="/register" class="nav-link">Register</router-link>
          </li>

          <li class="nav-item" v-if="authenticated">
            <router-link to="/dashboard" class="nav-link"
              >Dashboard</router-link
            >
          </li>
          <li class="nav-item" v-if="authenticated">
            <a
              class="nav-link"
              style="cursor: pointer"
              @click.prevent="logOutUserSubmit"
            >
              logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      token: localStorage.getItem("token"),
    };
  },
  mounted() {},
  methods: {
    ...mapActions(["logOutUser"]),
    logOutUserSubmit() {
      this.logOutUser()
        .then(() => {
          this.$router.replace({
            name: "Login",
          });
        })
        .catch((e) => {
          console.log("error", e);
        });
    },
  },
  computed: {
    ...mapGetters(["authenticated"]),
  },
};
</script>