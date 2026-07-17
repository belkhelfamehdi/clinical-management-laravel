<template>
  <div>
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Invoices</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.factures.length }} invoice(s) · Total: {{ totalRevenue }} DA</p>
      </div>
      <a href="/factures/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Invoice
      </a>
    </div>

    <div class="bg-white rounded-2xl border border-[#e5e5e7] overflow-hidden">
      <table class="min-w-full divide-y divide-[#e5e5e7]">
        <thead class="bg-[#fafafa]">
          <tr>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Patient</th>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Amount</th>
            <th class="px-6 py-3.5 text-right text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-[#e5e5e7]">
          <tr v-for="fact in props.factures" :key="fact.num" class="hover:bg-[#fafafa] transition-colors">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[#ff9500]/10 flex items-center justify-center text-[#ff9500] text-sm font-medium flex-shrink-0">
                  {{ fact.patient?.nom?.charAt(0)?.toUpperCase() }}
                </div>
                <div>
                  <p class="text-[13px] font-medium text-[#1d1d1f]">{{ fact.patient?.nom }} {{ fact.patient?.prenom }}</p>
                  <p class="text-[11px] text-[#86868b]">#{{ fact.num }}</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="text-[13px] font-medium text-[#1d1d1f]">{{ fact.Montant }} DA</span>
            </td>
            <td class="px-6 py-4 text-right">
              <button @click="deleteFacture(fact.num)" class="p-1.5 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 01-2-2h-2a2 2 0 012-2h2a2 2 0 012 2m-6 0h6"/>
                </svg>
              </button>
            </td>
          </tr>
          <tr v-if="props.factures.length === 0">
            <td colspan="3" class="px-6 py-16 text-center">
              <p class="text-[13px] text-[#86868b]">No invoices found</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  factures: Array
})

const totalRevenue = computed(() => {
  return props.factures.reduce((sum, f) => sum + f.Montant, 0)
})

const deleteFacture = (num) => {
  if (confirm('Delete this invoice?')) {
    router.delete(`/factures/${num}`)
  }
}
</script>
