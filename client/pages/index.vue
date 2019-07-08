<template>
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Home
      </h1>
    </div>
    <div class="row row-cards">
      <div class="col-md-3 col-xs-6" v-for="(category, index) in categories">
        <div id="accordion">
          <div class="card shadowing">
            <div v-if="! category.children.length">
              <div class="card-header">
                <h5 class="mb-0">
                  <nuxt-link :to="{name: 'categories'}" class="btn btn-link" style="" :key="category.slug">
                    <i :class="category.icon"></i> {{category.name}}
                  </nuxt-link>
                </h5>
              </div>
            </div>
            <div v-else>
              <div class="card-header collapsed">
                <h5 class="mb-0">
                  <nuxt-link :to="{name: 'categories'}" class="btn btn-link" style="" :key="category.slug">
                    <i :class="category.icon"></i> {{category.name}}
                  </nuxt-link>
                  <i
                    :id="'heading-'+index"
                    data-toggle="collapse"
                    :data-target="'#collapse-'+index"
                    aria-expanded="false"
                    :aria-controls="'#collapse-'+index"
                    class="fe fe-arrow-down float" ></i>
                </h5>
              </div>
              <div
                :id="'collapse-'+index"
                :aria-labelledby="'heading-'+index"
                data-parent="#accordion"
                class="collapse">
                <div class="card-body">
                  <ul class="list-group">
                    <li
                      v-for="(child, index) in category.children"
                      class="list-group-item list-group-item-light shadowing">
                      <a href="/" class="btn btn-link" v-text="child.name"></a>
                    </li>
                  </ul>
                </div>
              </div>
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
