<template>
  <div>
      <BaseHeading custom-heading="ER History"/>
      <div class="row">
        <div class="col-md-4 pl-lg-0 pr-lg-0 pl-md-0 pr-md-0">
            <Dropdown 
              custom-label="Last 15 days for value"
              :custom-data="dropdownData"
              @select-value="loadGraphData"
            />
        </div>
      </div>
      <div class="row">
        <trend
        :data="loadGraph"
        :gradient="['#28a745', '#1e7e34', '#ddd']"
        :autoDrawDuration=6000
        auto-draw
        smooth
        >
        </trend>
     </div>
  </div>
</template>
<script>
import BaseHeading from '../components/headings/BaseHeading.vue'
import Dropdown from '../components/inputs/Dropdown.vue'
import { globalState } from '../main.js';

export default {
  name: 'History',
  components: {
    BaseHeading,
    Dropdown
  },
  data(){
    return {
      dropdownData: globalState.rateData,
      historyData: globalState.historyData,
      loadGraph: [60, 61.3, 65, 60, 60, 61.3, 65, 60, 60, 61.3, 65, 60]
    }
  },
  methods: {
    loadGraphData: function (selected) {
      var populateData = [];
      this.historyData.forEach(element => {
        if(element.oznaka == selected){
          populateData.push(parseFloat(element.sreden));
        }

      });
      //console.log(populateData);
      this.loadGraph = populateData;
    }
  }
}
</script>
<style scoped>
</style>
