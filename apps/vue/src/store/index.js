import { createStore } from 'vuex'

export default createStore({
  state: {
    movies: {
      filters: {
        order: "",
        year: "",
        type: ""
      }
    }
  },

  getters: {
    get_filter_order(state) {
      return state.movies.filters.order
    },

    get_filter_year(state) {
      return state.movies.filters.year
    },

    get_filter_type(state) {
      return state.movies.filters.type
    },
  },

  mutations: {
    set_order(state) {
      const order =  state.movies.filters.order
      state.movies.filters.order = order
    },
    set_year(state) {
      const year = state.movies.filters.year
      state.movies.filters.year = year
    },
    set_type(state) {
      const type =  state.movies.filters.type
      state.movies.filters.type = type
    },
  },

  actions: {
    set_order_action(context) {
      context.commit("set_order")
    },
    set_year_action(context) {
      context.commit("set_year")
    },
    set_type_action(context) {
      context.commit("set_type")
    },
  },

  modules: {

  }
})
