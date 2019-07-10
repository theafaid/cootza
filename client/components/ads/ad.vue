<template>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h5>
          <nuxt-link :to="{name: 'ads-ad', params: {ad: ad.slug}}">{{ad.title}}</nuxt-link>
        </h5>
      </div>
      <div class="card-body d-flex flex-column">
        <a href="#"><img class="card-img-top" src="https://via.placeholder.com/150" alt="And this isn't my nose. This is a false one."></a>
      </div>
      <div class="card-footer">
        <span><i class="fe fe-clock "></i> {{ad.created_at}}</span>
        <div class="d-flex align-items-center pt-5 mt-auto">
          <div class="btn btn-secondary">
            <nuxt-link :to="mainCategoryLink" class="text-muted-dark">
              {{ad.category.parent.name}}
            </nuxt-link>
            >
            <nuxt-link :to="subCategoryLink" class="text-muted-dark">
              {{ad.category.name}}
            </nuxt-link>
          </div>
          <div class="ml-auto text-muted">
            <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      ad: {
        required: true,
        type: Object
      }
    },

    computed: {
      mainCategoryLink(){
        return {
          name: 'categories-category',
          params: {
            category: this.ad.category.parent.slug
          }
        };
      },

      subCategoryLink(){
        return {
          name: 'categories-category-subCategory',
          params: {
            category: this.ad.category.parent.slug,
            subCategory: this.ad.category.slug
          }
        };
      }
    }
  }
</script>
