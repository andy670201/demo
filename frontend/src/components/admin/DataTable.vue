<template>
  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left">
      <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
        <tr>
          <th v-for="col in columns" :key="col.key" class="px-4 py-3">{{ col.label }}</th>
          <th v-if="$slots.actions" class="px-4 py-3">操作</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row, idx) in data" :key="idx" class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
          <td v-for="col in columns" :key="col.key" class="px-4 py-3 text-gray-700">
            <slot :name="col.key" :row="row" :value="row[col.key]">{{ row[col.key] }}</slot>
          </td>
          <td v-if="$slots.actions" class="px-4 py-3">
            <slot name="actions" :row="row" />
          </td>
        </tr>
        <tr v-if="!data.length">
          <td :colspan="columns.length + ($slots.actions ? 1 : 0)" class="px-4 py-8 text-center text-gray-400">
            暫無資料
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps({
  columns: { type: Array, required: true },
  data: { type: Array, default: () => [] },
})
</script>
