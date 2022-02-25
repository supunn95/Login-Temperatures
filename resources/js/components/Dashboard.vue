<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Login Temperatures</div>

          <div class="card-body">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6 text-center">
                <button
                  style="margin-right: 10px"
                  type="button"
                  class="btn btn-danger"
                  @click="getUserTemperatureData('temperature_celsius', 'DESC')"
                >
                  Hottest First
                </button>
                <button
                  style="margin-left: 10px"
                  type="button"
                  class="btn btn-info"
                  @click="getUserTemperatureData('id', 'DESC')"
                >
                  Reset Order
                </button>
              </div>
            </div>
            <div class="row">
              <div
                class="col-sm-6"
                v-for="(city, index) in data.cities"
                :key="index"
              >
                <h1>{{ city.name }}</h1>
                <table
                  class="temperature-data-table display"
                  style="width: 100%"
                >
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody style="padding-top: 20px">
                    <tr
                      v-for="(temperature, index) in city.temperatures"
                      :key="index"
                    >
                      <td>{{ temperature.created_at }}</td>
                      <td>{{ temperature.temperature_celsius }} &#8451;</td>
                      <td>{{ temperature.temperature_fahrenheit }} &#8457;</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
import DataTable from "datatables.net";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      data: {},
      table: "",
    };
  },
  mounted() {
    this.getUserTemperatureData("id", "DESC");
  },
  computed: {
    ...mapGetters(["authenticated"]),
  },
  methods: {
    async getUserTemperatureData(type, order) {
      if (this.table) {
        this.table.destroy();
      }
      await axios
        .get("api/get_user_data?type=" + type + "&order=" + order)
        .then((response) => {
          this.data = response.data.data;

          this.$nextTick(() => {
            this.table = $(".temperature-data-table").DataTable({
              ordering: false,
            });
          });
        });
    },
  },
};
</script>

<style>
.dataTables_length {
  display: inline-block !important;
  padding-bottom: 30px;
}
.dataTables_filter {
  display: inline-block !important;
}
.dataTables_info {
  padding-top: 10px;
}
</style>
