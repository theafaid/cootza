<template>
  <div class="page">
    <div class="flex-fill">
      <navbar/>
      <div class="my-3 my-md-5">
        <nuxt />
      </div>
    </div>
    <foot></foot>
  </div>
</template>

<script>
  import Navbar from '@/layouts/partials/Navbar'
  import Footer from '@/layouts/partials/Footer'
  export default {
    components: {
      'navbar': Navbar,
      'foot': Footer
    }
  }
</script>
