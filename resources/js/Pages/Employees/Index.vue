<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Employés</h1>
        <p class="text-sm text-gray-500 mt-1">{{ employees.length }} employé(s)</p>
      </div>
      <a href="/employees/create" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvel employé
      </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6">
      <div class="flex gap-4">
        <div class="flex-1">
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
            <input v-model="search" type="text" placeholder="Rechercher un employé..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
          </div>
        </div>
      </div>
    </div>

    <!-- Employees Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="emp in filteredEmployees" :key="emp.id" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-semibold" :class="emp.gen === 'Homme' ? 'bg-blue-600' : 'bg-pink-600'">
            {{ emp.nom.charAt(0).toUpperCase() }}
          </div>
          <div class="flex-1">
            <h3 class="font-semibold text-gray-900">{{ emp.nom }} {{ emp.prenom }}</h3>
            <p class="text-sm text-gray-500">{{ emp.fonction || 'N/A' }}</p>
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
            <a :href="`/employees/${emp.id}/edit`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 111.414-1.414L11 10.586V7a2 2 0 01-2-2z"/>
              </svg>
            </a>
            <button @click="deleteEmployee(emp.id)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4H4a1 1 0 00-1 1v1a1 1 0 001 1h14a1 1 0 001-1V5a1 1 0 00-1-1h-5.586"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 space-y-2">
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            {{ emp.email }}
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 010 2H5v14h14v-4a1 1 0 112 0v5a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3.28a1 1 0 010 2H5z"/>
            </svg>
            {{ emp.num }}
          </div>
          <div class="flex items-center gap-2 text-sm">
            <span class="inline-flex px-2.5 py-0.5 text-xs font-medium rounded-full" :class="emp.gen === 'Homme' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700'">
              {{ emp.gen }}
            </span>
            <span class="text-gray-400">•</span>
            <span class="text-gray-500">{{ formatDate(emp.daten) }}</span>
          </div>
        </div>
      </div>

      <div v-if="filteredEmployees.length === 0" class="col-span-full">
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
          <p class="text-gray-500">Aucun employé trouvé</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  employees: Array
})

const search = ref('')

const filteredEmployees = computed(() => {
  if (!search.value) return employees
  const query = search.value.toLowerCase()
  return employees.filter(e => 
    e.nom.toLowerCase().includes(query) ||
    e.prenom.toLowerCase().includes(query) ||
    (e.fonction && e.fonction.toLowerCase().includes(query))
  )
})

const deleteEmployee = (id) => {
  if (confirm('Supprimer cet employé ?')) {
    router.delete(`/employees/${id}`)
  }
}

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR')
}
</script>
