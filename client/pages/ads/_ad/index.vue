<template>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <main-content :data="ad"></main-content>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Stats</h4>
            </div>
            <table class="table card-table">
              <tbody><tr>
                <td width="1"><i class="fa fa-chrome text-muted"></i></td>
                <td>Google Chrome</td>
                <td class="text-right"><span class="text-muted">23%</span></td>
              </tr>
              <tr>
                <td><i class="fa fa-firefox text-muted"></i></td>
                <td>Mozila Firefox</td>
                <td class="text-right"><span class="text-muted">15%</span></td>
              </tr>
              <tr>
                <td><i class="fa fa-safari text-muted"></i></td>
                <td>Apple Safari</td>
                <td class="text-right"><span class="text-muted">7%</span></td>
              </tr>
              <tr>
                <td><i class="fa fa-internet-explorer text-muted"></i></td>
                <td>Internet Explorer</td>
                <td class="text-right"><span class="text-muted">9%</span></td>
              </tr>
              <tr>
                <td><i class="fa fa-opera text-muted"></i></td>
                <td>Opera mini</td>
                <td class="text-right"><span class="text-muted">23%</span></td>
              </tr>
              <tr>
                <td><i class="fa fa-edge text-muted"></i></td>
                <td>Microsoft edge</td>
                <td class="text-right"><span class="text-muted">9%</span></td>
              </tr>
              </tbody></table>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Carousel with controls</h3>
            </div>
            <div class="card-body">
              <div id="carousel-controls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item">
                    <img class="d-block w-100" alt="" :src="ad.main_image" data-holder-rendered="true">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" alt="" :src="ad.main_image" data-holder-rendered="true">
                  </div>
                  <div class="carousel-item active">
                    <img class="d-block w-100" alt="" :src="ad.main_image" data-holder-rendered="true">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" alt="" :src="ad.main_image" data-holder-rendered="true">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" alt="" :src="ad.main_image" data-holder-rendered="true">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-controls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-controls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
              <video  controls>
                <source src="https://www.youtube.com/watch?v=VEV1rlzh-UI&list=WL&index=3" type="video/mp4">
                <source src="https://www.youtube.com/watch?v=VEV1rlzh-UI&list=WL&index=3" type="video/ogg">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
  import MainContent from '@/components/Ads/Single/MainContent'

  export default {

    components: {
      'main-content': MainContent
    },

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
