<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Factures</h1>
        <p class="text-sm text-gray-500 mt-1">{{ factures.length }} facture(s) • Total: {{ totalRevenue }} DA</p>
      </div>
      <a href="/factures/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle facture
      </a>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Montant</th>
            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          <tr v-for="fact in factures" :key="fact.num" class="hover:bg-gray-50 transition">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 font-semibold">
                  {{ fact.patient?.nom?.charAt(0)?.toUpperCase() }}
                </div>
                <div>
                  <p class="font-medium text-gray-900">{{ fact.patient?.nom }} {{ fact.patient?.prenom }}</p>
                  <p class="text-sm text-gray-500">#{{ fact.num }}</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="text-lg font-semibold text-gray-900">{{ fact.Montant }} DA</span>
            </td>
            <td class="px-6 py-4 text-right">
              <button @click="deleteFacture(fact.num)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 01-2-2h-2a2 2 0 012-2h2a2 2 0 012 2m-6 0h6"/>
                </svg>
              </button>
            </td>
          </tr>
          <tr v-if="factures.length === 0">
            <td colspan="3" class="px-6 py-12 text-center">
              <div class="flex flex-col items-center text-gray-400">
                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-sm">Aucune facture trouvée</p>
              </div>
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

defineProps({
  factures: Array
})

const totalRevenue = computed(() => {
  return factures.reduce((sum, f) => sum + f.Montant, 0)
})

const deleteFacture = (num) => {
  if (confirm('Supprimer cette facture ?')) {
    router.delete(`/factures/${num}`)
  }
}
</script>
