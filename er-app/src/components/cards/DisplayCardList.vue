<template>
  <div class="card mb-3 h-100">
    <div class="row no-gutters">
      <div class="col-12">
        <!-- <img src :alt="customData.oznaka" class="d-block mx-auto img-fluid"> -->
      </div>
      <div class="col-12">
        <div class="card-body">
          <p class="card-title text-center font-weight-bolder h5 text-uppercase pt-2">{{ customData.valuta_en }}</p>
          <p class="card-text">
              <table class="table text-center">
                <tbody>
                    <tr>
                        <th class="text-capitalize">purchase</th>
                        <td>{{ customData.kupoven }}</td>
                    </tr>
                    <tr>
                        <th class="text-capitalize">sales</th>
                        <td>{{ customData.prodazen }}</td>
                    </tr>
                    <tr>
                        <th class="text-capitalize">average</th>
                        <td>{{ customData.sreden }}</td>
                    </tr>
                </tbody>
            </table>
          </p>
          <p class="card-text text-right small">
            <span class="badge badge-danger p-2">{{ customData.oznaka }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "DisplayCardList",
  props: ['custom-data'],
  filters:{
      formatDate: function (value) {
          var date = new Date(value);
          return date.toLocaleDateString();
      }
  }
};
</script>