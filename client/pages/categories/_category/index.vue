<template>
  <div class="container">
    <div class="row">
      <ad  v-for="ad in ads" :ad="ad" :key="ad.slug"></ad>
    </div>
  </div>
</template>

<script>
  import Ad from '@/components/Ads/AdCard'

  export default {
    components: {
      ad: AdCard
    },

    data(){
      return {
        ads: []
      }
    },

    async asyncData(context){
      const response = await context.$axios.$get(`/ads?category=${context.params.category}`);

      return {ads: response.data};
    }
  }
</script>
