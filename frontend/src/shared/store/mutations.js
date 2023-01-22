export default () => {
  return {
    UNSELECT_ALL(state) {
      if (state.list.table) {
        state.list.table.clearSelection()
      }
    },

    TABLE_MOUNTED(state, payload) {
      state.list.table = payload
    },

    FETCH_STARTED(state, payload) {
      state.list.loading = true

      if (state.table) {
        state.list.table.clearSelection()
      }
    },

    FETCH_SUCCESS(state, payload) {
      state.list.loading = false
      for (const record of payload) {
        state.records[record.id] = record
      }
      state.list.ids = payload.map((r) => r.id)
      state.count = payload.length
    },

    FETCH_ERROR(state) {
      state.list.loading = false
      state.list.ids = []
      state.count = 0
    },

    CREATE_STARTED() {
    },
    CREATE_SUCCESS(state, record) {
      state.records[record.id] = record
      state.list.ids.push(record.id)
      state.list.count++
    },
    CREATE_ERROR() {
    },

    UPDATE_STARTED() {
    },
    UPDATE_SUCCESS(state, record) {
      state.records[record.id] = record
    },
    UPDATE_ERROR() {
    },

    DESTROY_STARTED() {
    },
    DESTROY_SUCCESS() {
    },
    DESTROY_ERROR() {
    },

    FIND_STARTED() {
    },
    FIND_SUCCESS(state, payload) {
      state.records[payload.id] = payload
    },
    FIND_ERROR() {
    }
  }
}
