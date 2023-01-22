<template>
  <div class="subscriber-list-filter">
    <el-input v-model="model" placeholder="Type to filter">
      <template #prefix>
        <el-icon class="el-input__icon">
          <search/>
        </el-icon>
      </template>
    </el-input>
  </div>
</template>

<script setup>
import {computed, defineEmits, defineProps} from 'vue'
import {Search} from '@element-plus/icons-vue'


const props = defineProps({
  modelValue: {
    type: String,
    default: null
  }
})

const emit = defineEmits(['update:modelValue'])

const model = computed({
  get() {
    return props.modelValue
  },
  set(v) {
    emit('update:modelValue', v)
  }
})
</script>

<style lang="scss">
.subscriber-list-filter {
  @apply max-w-xs;

  .el-input .el-input__wrapper {
    @apply bg-transparent rounded-md w-full text-gray-400;
    .el-input__inner {
      @apply h-6;
    }
  }
}
</style>