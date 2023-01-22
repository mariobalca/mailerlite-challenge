<template>
  <div class="flex items-center -mx-2">
    <el-input class="w-44 px-2" v-model="title"></el-input>
    <el-select class="w-44 px-2" v-model="type">
      <el-option value="string" label="string"></el-option>
      <el-option value="number" label="number"></el-option>
      <el-option value="boolean" label="boolean"></el-option>
      <el-option value="date" label="date"></el-option>
    </el-select>
    <div class="flex justify-end mx-2 flex-grow">
      <el-button class="btn btn__primary" @click="handleSave" :loading="loading">Save</el-button>
      <el-button class="btn btn__bordered" @click="handleCancel" :loading="loading">Cancel</el-button>
    </div>
  </div>
</template>

<script setup>
import {defineEmits, defineProps, ref} from 'vue'
import {mapActions} from "../../../shared/store/vuex.helpers";

const props = defineProps({
  field: {
    type: Object,
    default: () => {
    }
  }
})

const emit = defineEmits(['dismiss'])

const title = ref(props.field.title)
const type = ref(props.field.type)
const loading = ref(false)

const {doCreate, doUpdate} = mapActions('field')

const handleSave = async () => {
  if (!props.field.id) {
    loading.value = true
    await doCreate({
      title: title.value,
      type: type.value
    })
    loading.value = false
  } else {
    loading.value = true
    await doUpdate({
      id: props.field.id,
      values: {
        title: title.value,
        type: type.value
      }
    })
    loading.value = false
  }
  emit('dismiss')
}

const handleCancel = () => {
  emit('dismiss')
}
</script>