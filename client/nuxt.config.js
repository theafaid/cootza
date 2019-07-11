
export default {
  mode: 'universal',
  /*
  ** Headers of the page
  */
  head: {
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    style: [
      {rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/fontawesome.min.css'},
    ],
    script: [
      {src: "https://code.jquery.com/jquery-3.3.1.slim.min.js",
        integrity: "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo",
        crossorigin: "anonymous"},

      {src: "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js",
        integrity: "sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1",
        crossorigin: "anonymous"},

      {src: "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js",
        integrity: "sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM",
        crossorigin: "anonymous"}

    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#0080ff' },
  /*
  ** Global CSS
  */
  css: [
    "@/assets/css/dashboard.css"
  ],

  router: {
    middleware: ["clearValidationErrors"],
  },

  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    "~plugins/mixins/validation.js",
    "~plugins/mixins/user.js",
    "~plugins/axios.js"
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [

    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/auth'
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    baseURL: 'http://cootza.test'
  },

  auth: {
    strategies: {
      local: {
        endpoints: {
          login: {url: '/auth/login', method: 'post',propertyName: 'meta.token'},
          user: { url: '/auth/me', method: 'get', propertyName: 'data'},
          logout: {url: '/logout', method: 'post'}
        }
      }
    }
  },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {
    }
  }
}
