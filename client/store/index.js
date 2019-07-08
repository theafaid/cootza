export const state = () => ({
  categories: []
});

export const getters = {
  categories(state){
    return state.categories;
  }
};

export const mutations = {
  SET_CATEGORIES(state, categories){
    state.categories = categories;
  }
};

export const actions = {
  async nuxtServerInit(context){
    let response = await this.$axios.$get('categories');

    context.commit('SET_CATEGORIES', response);
  }
};
