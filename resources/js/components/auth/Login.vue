<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">Login</div>

          <div class="card-body">
            <form @submit.prevent="logInUserFormSubmit">
              <div class="form-group">
                <label for="email">Email address:</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  v-model="form_data.email"
                />
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input
                  type="password"
                  class="form-control"
                  id="pwd"
                  v-model="form_data.password"
                />
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary mt-2">
                      Login
                    </button>
                  </div>
                  <div class="col-sm-6 pt-2">
                    <!-- <router-link to="/register">Create new account</router-link> -->
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      form_data: {
        email: "",
        password: "",
        device_name: "browser",
      },
    };
  },

  methods: {
    ...mapActions(["logInUser"]),
    logInUserFormSubmit() {
      this.logInUser(this.form_data)
        .then(() => {
          this.$router.replace({
            name: "Dashboard",
          });
        })
        .catch((e) => {
          console.log("error", e);
        });
    },
  },
};
</script>
