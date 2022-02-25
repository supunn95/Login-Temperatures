<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">Register</div>

          <div class="card-body">
            <form @submit.prevent="registerUser">
              <div class="form-group">
                <label for="name">Name:</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  v-model="form_data.name"
                />
                <p class="text-danger" v-text="errors.name"></p>
              </div>
              <div class="form-group">
                <label for="email">Email address:</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  v-model="form_data.email"
                />
                <p class="text-danger" v-text="errors.email"></p>
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input
                  type="password"
                  class="form-control"
                  id="pwd"
                  v-model="form_data.password"
                />
                <p class="text-danger" v-text="errors.password"></p>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6">
                    <button
                      type="submit"
                      class="btn btn-primary mt-2"
                    >
                      Register
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
export default {
  data() {
    return {
      form_data: {
        name: "",
        email: "",
        password: "",
      },
      errors: {},
    };
  },

  methods: {
      registerUser(){
          axios.post('api/register', this.form_data).then((response) => {
              if(response.status == 200){
                  this.errors = {};
                  this.$router.push('/login');
              }
          }).catch((errors) => {
              this.errors = errors.response.data.errors;
          });
      }
  },
};
</script>
