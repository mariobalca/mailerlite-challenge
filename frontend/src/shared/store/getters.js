export default () => {
  return {
    rows: (state) =>
      state.list.ids.map((r) => state.records[r]),
    hasRows: (state) => state.count > 0,
    find: (state) => (id) => {
      return state.records[id]
    },
    loading: (state) => state.list.loading
  }
}
