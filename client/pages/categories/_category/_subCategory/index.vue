<template>
  <div class="container">
    <div class="row">
      <ad  v-for="ad in ads" :ad="ad" :key="ad.slug"></ad>
    </div>
  </div>
</template>

<script>
  import Ad from '@/components/ads/ad'

  export default {
    components: {
      ad: Ad
    },

    data(){
      return {
        ads: []
      }
    },

    async asyncData(context){
      const response = await context.$axios.$get(`/ads?category=${context.params.subCategory}`);

      return {ads: response.data};
    }
  }
</script>
