<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Patients</h1>
        <p class="text-sm text-gray-500 mt-1">{{ patients.length }} patient(s) enregistré(s)</p>
      </div>
      <a href="/patients/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau patient
      </a>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6">
      <div class="flex gap-4">
        <div class="flex-1">
          <input type="text" v-model="search" placeholder="Rechercher un patient..." class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
        </div>
      </div>
    </div>

    <!-- Patients Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Groupe</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date naissance</th>
            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          <tr v-for="patient in filteredPatients" :key="patient.id" class="hover:bg-gray-50 transition">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                  {{ patient.nom.charAt(0).toUpperCase() }}
                </div>
                <div>
                  <p class="font-medium text-gray-900">{{ patient.nom }} {{ patient.prenom }}</p>
                  <p class="text-sm text-gray-500">{{ patient.email }}</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <p class="text-sm text-gray-900">{{ patient.num }}</p>
              <p class="text-sm text-gray-500">{{ patient.addr }}</p>
            </td>
            <td class="px-6 py-4">
              <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full" :class="patient.gen === 'Homme' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700'">
                {{ patient.gs }}
              </span>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
              {{ formatDate(patient.daten) }}
            </td>
            <td class="px-6 py-4 text-right">
              <div class="flex justify-end gap-2">
                <a :href="`/patients/${patient.id}/edit`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 011.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
                  </svg>
                </a>
                <button @click="deletePatient(patient.id)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4H4a1 1 0 00-1 1v1a1 1 0 001 1h16a1 1 0 001-1V5a1 1 0 00-1-1h-5.586"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
          <tr v-if="filteredPatients.length === 0">
            <td colspan="5" class="px-6 py-12 text-center">
              <div class="flex flex-col items-center text-gray-400">
                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-8 7a6 6 0 0112 0v1H4v-1a6 6 0 0112 0z"/>
                </svg>
                <p class="text-sm">Aucun patient trouvé</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  patients: Array
})

const search = ref('')

const filteredPatients = computed(() => {
  if (!search.value) return patients
  const query = search.value.toLowerCase()
  return patients.filter(p => 
    p.nom.toLowerCase().includes(query) ||
    p.prenom.toLowerCase().includes(query) ||
    p.email.toLowerCase().includes(query)
  )
})

const deletePatient = (id) => {
  if (confirm('Supprimer ce patient ?')) {
    router.delete(`/patients/${id}`)
  }
}

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR')
}
</script>
