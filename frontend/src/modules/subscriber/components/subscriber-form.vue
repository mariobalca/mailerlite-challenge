<template>
  <div>
    <el-form
        label-position="top" class="pb-40">
      <el-form-item label="Email">
        <el-input v-model="email" placeholder="john.doe@email.com" class="w-full"></el-input>
      </el-form-item>
      <el-form-item label="Name">
        <el-input v-model="name" placeholder="John Doe" class="w-full"></el-input>
      </el-form-item>
      <el-form-item label="State">
        <el-select v-model="state" class="w-full">
          <el-option label="" value=""></el-option>
          <el-option label="active" value="active"></el-option>
          <el-option label="unsubscribed" value="unsubscribed"></el-option>
          <el-option label="junk" value="junk"></el-option>
          <el-option label="bounced" value="bounced"></el-option>
          <el-option label="unconfirmed" value="unconfirmed"></el-option>
        </el-select>
      </el-form-item>
      <span class="text-gray-500 font-semibold text-xs block mt-8">Custom Fields</span>
      <hr class="border-gray-600 mt-2 mb-4">
      <el-form-item v-for="field of fieldsFromStore" :key="field.id" :label="field.title">
        <el-input v-model="fields[field.title]" class="w-full"></el-input>
      </el-form-item>
      <div class="flex justify-end mx-2 flex-grow fixed bottom-0 right-0 mb-4 mr-4">
        <el-button class="btn btn__primary" @click="handleSave" :loading="loading">Save</el-button>
        <el-button class="btn btn__bordered" @click="handleCancel" :loading="loading">Cancel</el-button>
      </div>
    </el-form>
  </div>
</template>

<script setup>
import {defineEmits, defineProps, onMounted, reactive, ref} from 'vue'
import {mapActions, mapGetters} from "@/shared/store/vuex.helpers"

const props = defineProps({
  subscriber: {
    type: Object,
    default: () => {
    }
  }
})

const emit = defineEmits(['dismiss'])
const {rows: fieldsFromStore} = mapGetters('field')

const loading = ref(false)

const email = ref(props.subscriber.email)
const name = ref(props.subscriber.name)
const state = ref(props.subscriber.state)
const fields = reactive(
    Object
        .keys(props.subscriber.fields)
        .reduce((acc, item) => {
          acc[item] = props.subscriber.fields[item]
          return acc
        }, {}))

const {doCreate, doUpdate} = mapActions('subscriber')
const {doFetch: doFetchFields} = mapActions('field')

const handleSave = async () => {
  if (!props.subscriber.id) {
    loading.value = true
    await doCreate({
      email: email.value,
      name: name.value,
      state: state.value,
      fields
    })
    loading.value = false
  } else {
    loading.value = true
    await doUpdate({
      id: props.subscriber.id,
      values: {
        email: email.value,
        name: name.value,
        state: state.value,
        fields
      }
    })
    loading.value = false
  }
  emit('dismiss')
}

const handleCancel = () => {
  emit('dismiss')
}

onMounted(async () => {
  await doFetchFields()
})
</script>