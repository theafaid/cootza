<template>
  <div>
    <h6 v-for="ad in ads">
      <nuxt-link :to="{name: 'ads-ad', params: {ad: ad.slug}}">{{ad.title}}</nuxt-link>
    </h6>
  </div>
</template>

<script>
  export default {
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
