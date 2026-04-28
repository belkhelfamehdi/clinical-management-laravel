<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Congés</h1>
        <p class="text-sm text-gray-500 mt-1">{{ conges.length }} congé(s)</p>
      </div>
      <a href="/conges/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau congé
      </a>
    </div>

    <!-- Leaves Timeline -->
    <div class="space-y-4">
      <div v-for="conge in sortedConges" :key="conge.num_cn" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
        <div class="flex items-start justify-between">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl" :class="conge.employee?.gen === 'Homme' ? 'bg-blue-100 text-blue-600' : 'bg-pink-100 text-pink-600'">
              <svg class="w-6 h-6 mx-auto mt-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">{{ conge.employee?.nom }} {{ conge.employee?.prenom }}</h3>
              <p class="text-sm text-gray-500">{{ conge.employee?.fonction || 'N/A' }}</p>
            </div>
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
            <button @click="deleteConge(conge.num_cn)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 01-2-2h-2a2 2 0 012-2m3 0V3a2 2 0 00-2-2 2 2 0 00-2 2v1"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="mt-4 grid grid-cols-3 gap-4 text-sm">
          <div class="flex items-center gap-2 text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ formatDate(conge.dated) }}
          </div>
          <div class="flex items-center gap-2 text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ formatDate(conge.datef) }}
          </div>
          <div class="flex items-center gap-2 font-medium" :class="getDurationClass(conge)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ getDuration(conge) }} jours
          </div>
        </div>
      </div>

      <div v-if="conges.length === 0" class="col-span-full">
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
          <p class="text-gray-500">Aucun congé trouvé</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  conges: Array
})

const sortedConges = computed(() => {
  return [...conges].sort((a, b) => new Date(b.dated) - new Date(a.dated))
})

const deleteConge = (num_cn) => {
  if (confirm('Supprimer ce congé ?')) {
    router.delete(`/conges/${num_cn}`)
  }
}

const getDuration = (conge) => {
  return Math.ceil((new Date(conge.datef) - new Date(conge.dated)) / (1000*60*60*24))
}

const getDurationClass = (conge) => {
  const days = getDuration(conge)
  if (days > 14) return 'text-red-600'
  if (days > 7) return 'text-yellow-600'
  return 'text-green-600'
}

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR')
}
</script>
