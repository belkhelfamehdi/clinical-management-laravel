<template>
  <div>
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Salaries</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.salaires.length }} salary(ies) · Total: {{ formatCurrency(totalSalaries) }}</p>
      </div>
      <a href="/salaires/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Salary
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="item in props.salaires" :key="item.id" class="bg-white rounded-2xl border border-[#e5e5e7] p-5 hover:shadow-sm transition-shadow group">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#34c759]/10 flex items-center justify-center text-[#34c759] text-sm font-medium flex-shrink-0">
              {{ item.employee?.nom?.charAt(0)?.toUpperCase() }}
            </div>
            <div>
              <h3 class="text-[13px] font-medium text-[#1d1d1f]">{{ item.employee?.nom }} {{ item.employee?.prenom }}</h3>
              <p class="text-[11px] text-[#86868b]">{{ item.employee?.fonction || 'N/A' }}</p>
            </div>
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <a :href="`/salaires/${item.id}/edit`" class="p-1.5 text-[#0071e3] hover:bg-[#0071e3]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 011.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
              </svg>
            </a>
            <button @click="deleteSalaire(item.id)" class="p-1.5 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 112 0zM7 10a2 2 0 112 0z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="pt-3 border-t border-[#e5e5e7]">
          <p class="text-2xl font-semibold text-[#1d1d1f]">{{ formatCurrency(item.salaire) }}</p>
        </div>
      </div>

      <div v-if="props.salaires.length === 0" class="col-span-full">
        <div class="bg-white rounded-2xl border border-[#e5e5e7] py-16 text-center">
          <p class="text-[13px] text-[#86868b]">No salary records found</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  salaires: Array
})

const totalSalaries = computed(() => {
  return props.salaires.reduce((sum, item) => sum + item.salaire, 0)
})

const deleteSalaire = (id) => {
  if (confirm('Delete this salary record?')) {
    router.delete(`/salaires/${id}`)
  }
}

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('fr-DZ', { style: 'currency', currency: 'DZD' }).format(amount)
}
</script>
