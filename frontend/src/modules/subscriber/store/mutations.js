import sharedMutations from '@/shared/store/mutations'

function transformedRecord(record) {
  return {
    ...record,
    fields: record.fields.reduce((acc, item) => {
      acc[item.title] = item.subscriber_field.value
      return acc
    }, {})
  }
}

export default {
  ...sharedMutations(),
  FETCH_SUCCESS(state, payload) {
    state.list.loading = false
    for (const record of payload) {
      state.records[record.id] = transformedRecord(record)
    }
    state.list.ids = payload.map((r) => r.id)
    state.count = payload.length
  },
  FIND_SUCCESS(state, payload) {
    state.records[payload.id] = transformedRecord(record)
  },

  CREATE_SUCCESS(state, record) {
    state.records[record.id] = transformedRecord(record)
    state.list.ids.push(record.id)
    state.list.count++
  },
  UPDATE_SUCCESS(state, record) {
    state.records[record.id] = transformedRecord(record)
  }
}