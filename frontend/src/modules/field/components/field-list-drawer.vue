<template>
  <el-button class="btn btn__bordered" @click="drawerVisible = true">Manage Custom Fields</el-button>
  <el-drawer v-model="drawerVisible">
    <template #header>
      <div class="text-white font-semibold text-lg">
        Manage Custom Fields
      </div>
    </template>
    <field-list/>
  </el-drawer>
</template>

<script setup>
import {ref} from 'vue'
import FieldList from "./field-list.vue";

const drawerVisible = ref(false)
</script>