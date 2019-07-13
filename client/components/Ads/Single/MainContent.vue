<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" v-text="ad.title"></h3>
    </div>
    <div class="card-body">
      <img :src="ad.main_image" style="width: 100%;">
      <hr>
      <p>{{ad.description}}</p>
    </div>
    <div class="card-footer">
      <button class="btn btn-danger" data-toggle="modal" data-target=".make-offer-modal-lg" @click.prevent="fetchUserAds">Add Swap Offer</button>
    </div>


    <div class="modal fade make-offer-modal-lg" tabindex="-1" role="dialog" aria-labelledby="makeOfferModal" aria-hidden="true" v-if="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <table class="table card-table table-vcenter">
                  <tbody>
                  <tr v-for="userAd in userAds">
                    <td><img :src="ad.main_image" alt="" class="h-8"></td>
                    <td v-text="ad.title"></td>
                    <td class="text-right text-muted d-none d-md-table-cell text-nowrap">98 reviews</td>
                    <td class="text-right text-muted d-none d-md-table-cell text-nowrap">38 offers</td>
                    <td class="text-right">
                      <strong>$499</strong>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-4">
              test
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['data'],

    data(){
      return {
        ad: this.data,
        userAds: [],
        offer: {
          advertisements: [311, 312],
          money: 25000000
        }
      }
    },

    methods: {
      fetchUserAds(){
        this.$axios.post(`/ads/${this.ad.slug}/offers`, {offer: this.offer})
          .then(response => {
            console.log(response.data);
          });
        // this.$axios.get('/user/ads').then(response => {
        //   this.userAds = response.data;
        // })
      }
    }
  }
</script>
