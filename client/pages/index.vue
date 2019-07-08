<template>
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Home
      </h1>
    </div>
    <div class="row row-cards">
      <p>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
          Button with data-target
        </button>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
          Button with data-target
        </button>
      </p>
      <div class="collapse" id="collapseExample1">
        <div class="card card-body">
          one
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
      </div>
      <div class="collapse" id="collapseExample2">
        <div class="card card-body">
          two
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted(){
      this.$axios.$get('categories')
        .then(response => {
          console.log(response);
        });
    }
  }
</script>
