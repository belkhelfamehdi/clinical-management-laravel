<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Chambres</h1>
        <p class="text-sm text-gray-500 mt-1">{{ chambres.length }} chambre(s)</p>
      </div>
      <a href="/chambres/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle chambre
      </a>
    </div>

    <!-- Grid View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      <div v-for="ch in chambres" :key="ch.num" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 font-semibold">
            {{ ch.num }}
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
            <a :href="`/chambres/${ch.num}/edit`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 111.414-1.414L11 10.586V7a2 2 0 01-2-2h-2"/>
              </svg>
            </a>
            <button @click="deleteChambre(ch.num)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 01-2-2h-2a2 2 0 012-2h2a2 2 0 012 2z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="space-y-2">
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            {{ ch.patient ? ch.patient.nom + ' ' + ch.patient.prenom : 'Libre' }}
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 015.632 15H20a2 2 0 00-2-2h-4a2 2 0 01-2-2H9a2 2 0 01-2 2v.999a3 3 0 01-.879 2.121z"/>
            </svg>
            {{ ch.employee ? ch.employee.nom + ' ' + ch.employee.prenom : 'N/A' }}
          </div>
        </div>
      </div>

      <div v-if="chambres.length === 0" class="col-span-full">
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <p class="text-gray-500">Aucune chambre trouvée</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
  chambres: Array
})

const deleteChambre = (num) => {
  if (confirm('Supprimer cette chambre ?')) {
    router.delete(`/chambres/${num}`)
  }
}
</script>
