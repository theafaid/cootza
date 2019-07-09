<template>
    <p>
      {{ad}}
    </p>
</template>

<script>
  export default {

    data(){
      return {
        ad: null
      }
    },

    async asyncData(context){
      let response = await context.$axios.$get(`ads/${context.params.ad}`);
      return {ad: response.data};
    },
  }
</script>
