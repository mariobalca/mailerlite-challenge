<template>
  <div>
    <div class="flex justify-between">
      <subscriber-list-filter class="mb-4" v-model="query"/>
      <field-list-drawer></field-list-drawer>
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
      />
      <el-table-column
          label=""
          width="125"
          align="center"
      >
        <template #default="scope">
          Edit | Delete
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script setup>
import {mapActions, mapGetters} from "@/shared/store/vuex.helpers"
import {computed, onMounted, ref} from 'vue'
import {useStore} from 'vuex'
import SubscriberListFilter from "./subscriber-list-filter.vue"
import FieldListDrawer from "@/modules/field/components/field-list-drawer.vue"

const {doFetch} = mapActions('subscriber')
const {rows, hasRows, loading} = mapGetters('subscriber')

const store = useStore()

const computedRows = computed(() => {
  return rows.value.filter((r) => {
    return r.email.includes(query.value) ||
        r.name.includes(query.value) ||
        r.state?.includes(query.value)
  })
})

const query = ref('')

onMounted(async () => {
  await doFetch()
})
</script>