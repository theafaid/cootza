<template>
  <div class="container">
    <div class="row">
      <ad-card v-for="ad in ads" :ad="ad" :key="ad.slug"></ad-card>
    </div>
  </div>
</template>

<script>
  import AdCard from '@/components/Ads/AdCard'

  export default {
    components: {
      'ad-card': AdCard
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
