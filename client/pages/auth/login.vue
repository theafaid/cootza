<template>
  <div class="col col-login mx-auto">
    <div class="text-center mb-6">
<!--      <img src="./demo/brand/tabler.svg" class="h-6" alt="">-->
    </div>
    <form class="card" @submit.prevent="login">
      <div class="card-body p-6">
        <div class="card-title">Login to your account</div>
        <div class="form-group">
          <label class="form-label">Email address</label>
          <input class="form-control" aria-describedby="emailHelp" placeholder="Enter email" v-model="form.email">
          <span class="text-red">{{errors}}</span>
        </div>
        <div class="form-group">
          <label class="form-label">
            Password
            <a href="./forgot-password.html" class="float-right small">I forgot password</a>
          </label>
          <input type="password" class="form-control" placeholder="Password" v-model="form.password">
        </div>
        <div class="form-group">
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-label">Remember me</span>
          </label>
        </div>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </div>
      </div>
    </form>
    <div class="text-center text-muted">
      Don't have account yet? <a href="./register.html">Sign up</a>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        form: {
          email: '',
          password: ''
        }
      }
    },

    methods: {
      async login(){
        await this.$auth.loginWith('local', {data: this.form});

        this.$router.replace({
          name: 'index'
        });
      }
    }
  }
</script>
