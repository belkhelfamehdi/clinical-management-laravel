<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Employees</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.employees.length }} employee(s)</p>
      </div>
      <a href="/employees/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Employee
      </a>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-2xl border border-[#e5e5e7] p-4 mb-6">
      <input v-model="search" type="text" placeholder="Search employees..." class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] placeholder-[#86868b] outline-none focus:ring-2 focus:ring-[#0071e3]/20">
    </div>

    <!-- Employees Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="emp in filteredEmployees" :key="emp.id" class="bg-white rounded-2xl border border-[#e5e5e7] p-5 hover:shadow-sm transition-shadow group">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-sm font-medium" :class="emp.gen === 'Homme' ? 'bg-[#0071e3]' : 'bg-[#ff2d55]'">
              {{ emp.nom.charAt(0).toUpperCase() }}
            </div>
            <div>
              <h3 class="text-[13px] font-medium text-[#1d1d1f]">{{ emp.nom }} {{ emp.prenom }}</h3>
              <p class="text-[11px] text-[#86868b]">{{ emp.fonction || 'N/A' }}</p>
            </div>
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <a :href="`/employees/${emp.id}/edit`" class="p-1.5 text-[#0071e3] hover:bg-[#0071e3]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 011.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
              </svg>
            </a>
            <button @click="deleteEmployee(emp.id)" class="p-1.5 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4H4a1 1 0 00-1 1v1a1 1 0 001 1h14a1 1 0 001-1V5a1 1 0 00-1-1h-5.586"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="space-y-2 pt-3 border-t border-[#e5e5e7]">
          <div class="flex items-center gap-2 text-[12px] text-[#86868b]">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            {{ emp.email }}
          </div>
          <div class="flex items-center gap-2 text-[12px] text-[#86868b]">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 010 2H5v14h14v-4a1 1 0 112 0v5a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3.28a1 1 0 010 2H5z"/>
            </svg>
            {{ emp.num }}
          </div>
        </div>
      </div>

      <div v-if="filteredEmployees.length === 0" class="col-span-full">
        <div class="bg-white rounded-2xl border border-[#e5e5e7] py-16 text-center">
          <p class="text-[13px] text-[#86868b]">No employees found</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  employees: Array
})

const search = ref('')

const filteredEmployees = computed(() => {
  if (!search.value) return props.employees
  const query = search.value.toLowerCase()
  return props.employees.filter(e =>
    e.nom.toLowerCase().includes(query) ||
    e.prenom.toLowerCase().includes(query) ||
    (e.fonction && e.fonction.toLowerCase().includes(query))
  )
})

const deleteEmployee = (id) => {
  if (confirm('Delete this employee?')) {
    router.delete(`/employees/${id}`)
  }
}
</script>
