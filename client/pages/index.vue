<template>
  <div class="container">
    <div class="page-header">
      <i class="icon-shopping-bag"></i>
      <div class="col-lg-12 ml-auto">
        <form class="input-icon my-3 my-lg-0">
          <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
          <div class="input-icon-addon">
            <i class="fe fe-search"></i>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-xs-6" v-for="(category, index) in categories">
        <div v-if="! category.children.length">
          <div class="card p-3">
            <div class="d-flex align-items-center">
              <span class="stamp stamp-md bg-blue mr-3">
                <i class="fe fe-dollar-sign"></i>
              </span>
              <div>
                <h6 class="m-0">
                  <nuxt-link class="text-muted-dark" :to="{name: 'categories-category', params: {category: category.slug}}" v-text="category.name"></nuxt-link>
                </h6>
              </div>
            </div>
          </div>
        </div>
        <div v-else>
          <div class="card p-3" data-toggle="collapse" :data-target="'#collapse-'+category.slug" aria-expanded="true" :aria-controls="'collapse-'+category.slug">
            <div class="d-flex align-items-center">
              <span class="stamp stamp-md bg-blue mr-3">
                <i class="fe fe-dollar-sign"></i>
              </span>
              <div>
                <h6 class="m-0 text-muted-dark btn btn-link" v-text="category.name">
                </h6>
              </div>
            </div>
          </div>

          <div class="collapse" :id="'collapse-'+category.slug">
            <div class="card card-body">
              <h6 v-for="(child, index) in category.children">
                <nuxt-link :to="{name: 'categories-category-subCategory', params: {category: category.slug, subCategory: child.slug}}">
                  {{child.name}}
                </nuxt-link>
              </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    computed: {
      ...mapGetters(['categories'])
    }
  }
</script>


<style>
  .shadowing {
    box-shadow: 5px 5px 25px 0px rgba(46, 61, 73, 0.2);
  }
</style>
