<template>
  <div class="form-group">
    <label class="font-weight-bolder text-uppercase small">{{ customLabel }}</label>
    <select class="form-control" v-model="selected" @change="selectedValue" required>
      <option value="" disabled hidden>{{ selectedOption }}</option>
      <option v-if="displayDenar" :value="denar.oznaka" :data-value="denar.sreden">{{ denar.valuta_en }}</option>
      <option v-for="option in customData" :key="option.oznaka" :value="option.oznaka" :data-value="option.sreden" >{{ option.valuta_en }}</option>
    </select>
  </div>
</template>
<script>
export default {
  name: 'Dropdown',
  props: ['custom-label', 'custom-data', 'display-denar'],
  data() {
    return {
      selectedOption: 'Select value...',
      selected: '',
      denar: {
        datum: "",
        oznaka: "MKD",
        kupoven: "1",
        sreden: "1",
        prodazen: "1",
        valuta_id: "1",
        edinica: "1",
        drzava_mk: "MK",
        drzava_en: "MKD",
        valuta_mk: "македонски денар",
        valuta_en: "Macedonian denar",
      }
    };
  },
  methods: {
    selectedValue: function () {
      this.$emit('select-value', this.selected); 
    }
  }
};
</script>
