<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Salaires</h1>
        <p class="text-sm text-gray-500 mt-1">{{ salaires.length }} salaire(s) • Total: {{ formatCurrency(totalSalaries) }}</p>
      </div>
      <a href="/salaires/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau salaire
      </a>
    </div>

    <!-- Salary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="item in salaires" :key="item.id" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-600 font-semibold">
              {{ item.employee?.nom?.charAt(0)?.toUpperCase() }}
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">{{ item.employee?.nom }} {{ item.employee?.prenom }}</h3>
              <p class="text-sm text-gray-500">{{ item.employee?.fonction || 'N/A' }}</p>
            </div>
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
            <a :href="`/salaires/${item.id}/edit`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 111.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
              </svg>
            </a>
            <button @click="deleteSalaire(item.id)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="pt-4 border-t border-gray-100">
          <p class="text-3xl font-bold text-gray-900">{{ formatCurrency(item.salaire) }}</p>
          <p class="text-xs text-gray-500 mt-1">{{ item.employee?.gen }} • {{ item.employee?.email }}</p>
        </div>
      </div>

      <div v-if="salaires.length === 0" class="col-span-full">
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-2 3-1.657 2-3-2-3-3zm0 0c1.657 0 3-.895 3-2s-1.343-2-3-2-3 2-3 1.657 2 3z"/>
          </svg>
          <p class="text-gray-500">Aucun salaire trouvé</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  salaires: Array
})

const totalSalaries = computed(() => {
  return salaires.reduce((sum, item) => sum + item.salaire, 0)
})

const deleteSalaire = (id) => {
  if (confirm('Supprimer ce salaire ?')) {
    router.delete(`/salaires/${id}`)
  }
}

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('fr-DZ', { style: 'currency', currency: 'DZD' }).format(amount)
}
</script>
