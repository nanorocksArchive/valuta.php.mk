<template>
   <div>
    <BaseHeading custom-heading="Er About"/>   
    <div class="row">
      <div class="col pl-lg-0 pr-lg-0 pl-md-0 pr-md-0">
         <p class="text-justify" v-for="p in pas" v-html="p.p" :key="p.p"></p>
      </div>
    </div> 
  </div>
</template>
<script>
import BaseHeading from '../components/headings/BaseHeading.vue'

export default {
  name: 'About',
  components: {
    BaseHeading
  },
  data(){
    return {
      pas: [
        {
          p: 'ER APP - <strong>Exchange Rate App</strong> is a SPA app build with bootstrap and vue.js The purpose of the app is to demonstrate the learning curve and to use real-time data. Currently, the data is taken from API who is built on top of the NBRM-API in Macedonia.'
        },
        {
          p: 'The data is relevant and can be found on the NBRM page also. Next for development maybe is to make a mobile version for the app. Let me know if you want to contribute and give help to the open-source community. The full project can be found on my GitHub profile.'
        },
        {
          p: 'You can reach me by visiting my web page. Thank you and have a nice day :) '
        }
      ]
    }
  }
}
</script>