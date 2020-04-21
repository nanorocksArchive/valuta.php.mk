<template>
  <div>
    <BaseHeading 
      custom-heading="ER List"
    />
    <div class="row pb-5 mb-5">
      <div class="col-md-4 mb-3" v-for="card in cardList" :key="card.oznaka">
        <DisplayCardList 
         :custom-data="card"
        />
      </div>
    </div>
  </div>
</template>

<script>
import BaseHeading from '../components/headings/BaseHeading.vue';
import DisplayCardList from '../components/cards/DisplayCardList';
import { globalState } from '../main.js';

export default {
  name: "List",
  components:{
    BaseHeading,
    DisplayCardList
  },
  data() {
    return {
      cardList: globalState.rateData
    };
  }
};
</script>
