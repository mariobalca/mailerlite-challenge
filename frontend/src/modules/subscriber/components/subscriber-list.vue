<template>
  <div>
    <div class="flex justify-between mb-4">
      <subscriber-list-filter v-model="query"/>
      <div class="flex items-center">
        <el-button class="btn btn__primary" @click="adding = true">Add Subscriber</el-button>
        <field-list-drawer></field-list-drawer>
      </div>
    </div>
    <el-table :data="computedRows" ref="table" v-loading="loading">
      <el-table-column
          label="Name"
          prop="name"
          width="250"
      />
      <el-table-column
          label="Email"
          prop="email"
          width="250"
      >
        <template #default="scope">
          <a class="underline"
             :href="`mailto:${scope.row.email}`">
            {{ scope.row.email }}
          </a>
        </template>
      </el-table-column>
      <el-table-column
          label="State"
          prop="state"
      />
      <el-table-column
          label="Custom Fields"
          prop="fields"
      >
        <template #default="scope">
          <div v-for="field of Object.keys(scope.row.fields)" :key="field" class="flex items-center">
            <span class="block font-semibold leading-tight">{{ field }}:</span>
            <span class="block ml-1 leading-tight">{{ scope.row.fields[field] }}</span>
          </div>
        </template>
      </el-table-column>
      <el-table-column
          label=""
          width="125"
          align="center"
      >
        <template #default="scope">
          <span class="text-brand-900 hover:underline cursor-pointer mr-3" @click="handleEdit(scope.row.id)">Edit</span>
          <span class="text-brand-900 hover:underline cursor-pointer" @click="handleDelete(scope.row.id)">Delete</span>
        </template>
      </el-table-column>
    </el-table>
    <el-drawer v-model="drawerVisible" destroy-on-close>
      <template #header>
        <div class="text-white font-semibold text-lg">
          {{ editing ? 'Edit' : 'Add' }} subscriber
        </div>
      </template>
      <subscriber-form :subscriber="editing ? find(editing) : {}" @dismiss="drawerVisible = false"></subscriber-form>
    </el-drawer>
  </div>
</template>

<script setup>
import {computed, onMounted, ref} from 'vue'
import {useStore} from 'vuex'
import {ElMessageBox} from 'element-plus'
import SubscriberListFilter from "./subscriber-list-filter.vue"
import {mapActions, mapGetters} from "@/shared/store/vuex.helpers"
import FieldListDrawer from "@/modules/field/components/field-list-drawer.vue"
import SubscriberForm from "./subscriber-form.vue";

const {doFetch, doDestroy} = mapActions('subscriber')
const {rows, loading, find} = mapGetters('subscriber')

const store = useStore()

const computedRows = computed(() => {
  return rows.value.filter((r) => {
    return r.email.includes(query.value) ||
        r.name.includes(query.value) ||
        r.state?.includes(query.value)
  })
})

const query = ref('')
const adding = ref(null)
const editing = ref(null)

const drawerVisible = computed({
  get() {
    return adding.value !== null || editing.value !== null
  },
  set() {
    adding.value = null
    editing.value = null
  }
})

onMounted(async () => {
  await doFetch()
})

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