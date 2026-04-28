<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Pharmacie</h1>
        <p class="text-sm text-gray-500 mt-1">{{ medicaments.length }} médicament(s)</p>
      </div>
      <a href="/medicaments/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau médicament
      </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6">
      <input type="text" v-model="search" placeholder="Rechercher un médicament..." class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
    </div>

    <!-- Grid View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      <div v-for="med in filteredMedicaments" :key="med.numM" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z"/>
            </svg>
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
            <a :href="`/medicaments/${med.numM}/edit`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 011.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
              </svg>
            </a>
            <button @click="deleteMedicament(med.numM)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4H4a1 1 0 00-1 1v1a1 1 0 001 1h14a1 1 0 001-1V5a1 1 0 00-1-1h-5.586"/>
              </svg>
            </button>
          </div>
        </div>
        <h3 class="font-semibold text-gray-900 mb-2">{{ med.nom }}</h3>
        <div class="flex items-center gap-2">
          <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full" :class="med.quantite > 50 ? 'bg-green-100 text-green-700' : med.quantite > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'">
            {{ med.quantite }} en stock
          </span>
        </div>
      </div>

      <div v-if="filteredMedicaments.length === 0" class="col-span-full">
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z"/>
          </svg>
          <p class="text-gray-500">Aucun médicament trouvé</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  medicaments: Array
})

const search = ref('')

const filteredMedicaments = computed(() => {
  if (!search.value) return medicaments
  const query = search.value.toLowerCase()
  return medicaments.filter(m => m.nom.toLowerCase().includes(query))
})

const deleteMedicament = (numM) => {
  if (confirm('Supprimer ce médicament ?')) {
    router.delete(`/medicaments/${numM}`)
  }
}
</script>
