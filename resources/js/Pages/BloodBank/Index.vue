<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Banque de Sang</h1>
        <p class="text-sm text-gray-500 mt-1">Gestion des donneurs et stock sanguin</p>
      </div>
      <a href="/donneurs/create" class="flex items-center gap-2 bg-red-600 text-white px-4 py-2.5 rounded-xl hover:bg-red-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau donneur
      </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
      <div v-for="stock in stocks" :key="stock.gs" 
           class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center"
           :class="stock.quantite > 20 ? 'border-l-4 border-l-green-500' : stock.quantite > 10 ? 'border-l-4 border-l-yellow-500' : 'border-l-4 border-l-red-500'">
        <div class="text-3xl font-bold" :class="stock.quantite > 20 ? 'text-green-600' : stock.quantite > 10 ? 'text-yellow-600' : 'text-red-600'">
          {{ stock.quantite }}
        </div>
        <div class="text-sm text-gray-500 mt-1">{{ stock.gs }}</div>
      </div>
    </div>

    <!-- Donneurs Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div class="p-6 border-b border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900">Liste des donneurs</h3>
      </div>
      <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Donneur</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Groupe</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          <tr v-for="donneur in donneurs" :key="donneur.id" class="hover:bg-gray-50 transition">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-semibold">
                  {{ donneur.nom.charAt(0).toUpperCase() }}
                </div>
                <div>
                  <p class="font-medium text-gray-900">{{ donneur.nom }} {{ donneur.prenom }}</p>
                  <p class="text-sm text-gray-500">{{ donneur.numero }}</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <p class="text-sm text-gray-900">{{ donneur.email || 'N/A' }}</p>
            </td>
            <td class="px-6 py-4">
              <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full" :class="getBloodGroupClass(donneur.gs)">
                {{ donneur.gs }}
              </span>
            </td>
          </tr>
          <tr v-if="donneurs.length === 0">
            <td colspan="3" class="px-6 py-12 text-center">
              <div class="flex flex-col items-center text-gray-400">
                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v5m-8 0l-8 4m8-4v5m8 0l8 4-8-4-8-4 8 4"/>
                </svg>
                <p class="text-sm">Aucun donneur enregistré</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
defineProps({
  stocks: Array,
  donneurs: Array
})

const getBloodGroupClass = (gs) => {
  const classes = {
    'A+': 'bg-red-100 text-red-700',
    'A-': 'bg-orange-100 text-orange-700',
    'B+': 'bg-blue-100 text-blue-700',
    'B-': 'bg-cyan-100 text-cyan-700',
    'AB+': 'bg-purple-100 text-purple-700',
    'AB-': 'bg-pink-100 text-pink-700',
    'O+': 'bg-green-100 text-green-700',
    'O-': 'bg-yellow-100 text-yellow-700'
  }
  return classes[gs] || 'bg-gray-100 text-gray-700'
}
</script>
