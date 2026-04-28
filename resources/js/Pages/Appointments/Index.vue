<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Rendez-vous</h1>
        <p class="text-sm text-gray-500 mt-1">{{ rendezvous.length }} rendez-vous(s)</p>
      </div>
      <a href="/appointments/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau rendez-vous
      </a>
    </div>

    <!-- Timeline View -->
    <div class="space-y-4">
      <div v-for="rdv in sortedRendezVous" :key="rdv.num" 
           class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <div class="flex items-start gap-4">
          <!-- Date Badge -->
          <div class="flex-shrink-0 w-16 text-center">
            <div class="text-2xl font-bold text-blue-600">{{ getDay(rdv.date) }}</div>
            <div class="text-xs text-gray-500">{{ getMonth(rdv.date) }}</div>
          </div>

          <!-- Content -->
          <div class="flex-1">
            <div class="flex items-center justify-between mb-3">
              <div>
                <h3 class="font-semibold text-gray-900">
                  {{ rdv.patient?.nom }} {{ rdv.patient?.prenom }}
                </h3>
                <p class="text-sm text-gray-500">
                  Dr. {{ rdv.doctor?.nom }} {{ rdv.doctor?.prenom }}
                </p>
              </div>
              <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full" 
                    :class="rdv.status === 'confirmé' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'">
                {{ rdv.status || 'En attente' }}
              </span>
            </div>
            <div class="flex items-center gap-4 text-sm text-gray-500">
              <div class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002 2v-12a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                {{ formatDate(rdv.date) }}
              </div>
              <div class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ rdv.patient?.gs }}
              </div>
            </div>
          </div>

          <!-- Actions -->
          <div class="flex gap-1">
            <button @click="deleteRdv(rdv.num)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 112 0zM7 10a2 2 0 112 0z"/>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <div v-if="rendezvous.length === 0" class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002 2v-12a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
        </svg>
        <p class="text-gray-500">Aucun rendez-vous programmé</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  rendezvous: Array
})

const sortedRendezVous = computed(() => {
  return [...rendezvous].sort((a, b) => new Date(b.date) - new Date(a.date))
})

const deleteRdv = (num) => {
  if (confirm('Supprimer ce rendez-vous ?')) {
    router.delete(`/appointments/${num}`)
  }
}

const getDay = (date) => {
  if (!date) return ''
  return new Date(date).getDate()
}

const getMonth = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR', { month: 'short' })
}

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR')
}
</script>
