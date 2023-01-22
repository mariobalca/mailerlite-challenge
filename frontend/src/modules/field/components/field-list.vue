<template>
  <div>
    <div v-loading="loading" v-if="loading" class="h-40"></div>
    <div v-else>
      <div class="flex items-center border-b border-gray-400 pb-1 text-sm font-bold text-gray-500">
        <div class="w-44">Title</div>
        <div class="w-44">Type</div>
      </div>
      <div v-for="row of rows" :key="row.id" class="border-b border-gray-400 py-3 text-sm">
        <transition mode="out-in" name="fade">
          <div v-if="editing !== row.id" class="flex items-center ">
            <div class="text-white w-44">{{ row.title }}</div>
            <div class="text-white w-44">{{ row.type }}</div>
            <div class="text-white flex-grow text-right">
              <span class="text-brand-900 hover:underline cursor-pointer mr-3" @click="handleEdit(row.id)">Edit</span>
              <span class="text-brand-900 hover:underline cursor-pointer" @click="handleDelete(row.id)">Delete</span>
            </div>
          </div>
          <field-form v-else :field="row" @dismiss="handleDismiss"></field-form>
        </transition>
      </div>
      <div class="py-2">
        <field-form :field="{ title: null, type: null }" v-if="adding" @dismiss="adding = false"></field-form>
        <span v-else class="text-brand-900 hover:underline cursor-pointer text-sm mt-4"
              @click="adding = true">Add new</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import {mapActions, mapGetters} from "../../../shared/store/vuex.helpers"
import {onMounted, ref} from 'vue'
import FieldForm from './field-form.vue'
import {ElMessageBox} from 'element-plus'


const {doFetch, doDestroy} = mapActions('field')
const {rows, loading} = mapGetters('field')

const adding = ref(false)
const editing = ref(null)

onMounted(async () => {
  await doFetch()
})

const handleDismiss = () => {
  editing.value = null
}

const handleEdit = (id) => {
  editing.value = id
}

const handleDelete = async (id) => {
  try {
    await ElMessageBox.confirm(
        "Are you sure?",
        "Confirm",
        {
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          type: 'warning'
        }
    )

    await doDestroy(id)
  } catch (error) {
    // no
  }
}
</script>