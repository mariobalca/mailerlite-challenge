export default (moduleName, moduleService = null) => {
  const asyncActions = moduleService
    ? {
      async doFetch(
        { commit, getters }
      ) {
        try {
          commit('FETCH_STARTED')

          const response = await moduleService.list()

          commit('FETCH_SUCCESS', response)
        } catch (error) {
          console.log(error)
          commit('FETCH_ERROR')
        }
      },

      async doFind({ commit }, id) {
        try {
          commit('FIND_STARTED')
          const record = await moduleService.find(id)
          commit('FIND_SUCCESS', record)
          return record
        } catch (error) {
          console.log(error)
          commit('FIND_ERROR')
        }
      },

      async doDestroy({ commit, dispatch }, id) {
        try {
          commit('DESTROY_STARTED')

          await moduleService.destroy(id)

          commit('DESTROY_SUCCESS')


          dispatch('doFetch')
        } catch (error) {
          console.log(error)
          commit('DESTROY_ERROR')
        }
      },

      async doCreate({ commit }, values) {
        try {
          commit('CREATE_STARTED')
          const response = await moduleService.create(
            values
          )
          commit('CREATE_SUCCESS', response)


          return response
        } catch (error) {
          console.log(error)
          commit('CREATE_ERROR')

          return false
        }
      },

      async doUpdate({ commit }, { id, values }) {
        try {
          commit('UPDATE_STARTED')

          const response = await moduleService.update(
            id,
            values
          )

          commit('UPDATE_SUCCESS', response)

          return response
        } catch (error) {
          console.log(error)
          commit('UPDATE_ERROR')

          return false
        }
      }
    }
    : {}

  return {
    ...asyncActions,
    doUnselectAll({ commit }) {
      commit('UNSELECT_ALL')
    },

    doMountTable({ commit }, table) {
      commit('TABLE_MOUNTED', table)
    },

    doReset({ commit, dispatch }) {
      commit('RESETED')
      return dispatch('doFetch', {})
    }
  }
}
