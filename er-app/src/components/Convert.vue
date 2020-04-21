<template>
  <div>
    <BaseHeading custom-heading="Er Convert" />
    <div class="row">
      <div class="col-md-6 pl-lg-0 pr-lg-0 pl-md-0 pr-md-0">
        <form @submit.prevent>
          <Dropdown
            custom-label="From value:"
            :custom-data="dropdownData"
            display-denar="1"
            @select-value="from"
          />
          <Dropdown
            custom-label="To value:"
            :custom-data="dropdownData"
            display-denar="1"
            @select-value="to"
          />
          <TextField custom-label="Money value:" custom-placeholder="ex. 29.6" @get-text="rate" />

          <Button custom-name="Calculate" custom-class="btn-dark" v-on:click.native="calculate" />
        </form>
      </div>
      <div class="col-md-6">
        <DisplayConvertValue
          :custom-value="displayConvertValue.value"
          :custom-rate="displayConvertValue.rate"
        />
      </div>
    </div>
  </div>
</template>
<script>
import BaseHeading from "../components/headings/BaseHeading.vue";
import Dropdown from "../components/inputs/Dropdown.vue";
import TextField from "../components/inputs/TextField.vue";
import DisplayConvertValue from "../components/cards/DisplayConvertValue.vue";
import Button from "../components/inputs/Button.vue";
import { globalState } from "../main.js";

export default {
  name: "Convert",
  components: {
    BaseHeading,
    Dropdown,
    TextField,
    DisplayConvertValue,
    Button
  },
  data() {
    return {
      dropdownData: globalState.rateData,
      displayConvertValue: {
        value: "0.00",
        rate: ""
      },
      fromValue: "",
      toValue: "",
      money: ""
    };
  },
  methods: {
    from: function(selected) {
      return (this.fromValue = selected);
    },
    to: function(selected) {
      return (this.toValue = this.displayConvertValue.rate = selected);
    },
    rate: function(money) {
      return (this.money = money);
    },
    calculate: function(params) {
      var from = 1, to = 1;
      var money = this.money;
      this.dropdownData.forEach(element => {
        // console.log(element.oznaka, this.fromValue);
        if (element.oznaka == this.fromValue) {
          from = element.sreden;
        }
        if (element.oznaka == this.toValue) {
          to = element.sreden;
        }
      });

      this.displayConvertValue.value = ((from/to)*money).toFixed(2); 

    }
  }
};
</script>