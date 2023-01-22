import { createStore as createVuexStore } from 'vuex'

import modules from '@/modules'

const buildStores = () => {
  const output = {}

  Object.keys(modules)
    .filter((key) => Boolean(modules[key].store))
    .forEach((key) => {
      output[key] = modules[key].store
    })

  return output
}

let store

const createStore = () => {
  if (!store) {
    store = createVuexStore({
      modules: buildStores()
    })
  }
  return store
}

export { createStore, store }
