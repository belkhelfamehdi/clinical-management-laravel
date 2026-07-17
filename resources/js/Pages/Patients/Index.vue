<template>
  <div>
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Patients</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.patients.length }} patient(s)</p>
      </div>
      <a href="/patients/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Patient
      </a>
    </div>

    <div class="bg-white rounded-2xl border border-[#e5e5e7] p-4 mb-6">
      <input type="text" v-model="search" placeholder="Search patients..." class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] placeholder-[#86868b] outline-none focus:ring-2 focus:ring-[#0071e3]/20">
    </div>

    <div class="bg-white rounded-2xl border border-[#e5e5e7] overflow-hidden">
      <table class="min-w-full divide-y divide-[#e5e5e7]">
        <thead class="bg-[#fafafa]">
          <tr>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Patient</th>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Contact</th>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Blood</th>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">DOB</th>
            <th class="px-6 py-3.5 text-right text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-[#e5e5e7]">
          <tr v-for="patient in filteredPatients" :key="patient.id" class="hover:bg-[#fafafa] transition-colors">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[#0071e3]/10 flex items-center justify-center text-[#0071e3] text-sm font-medium flex-shrink-0">
                  {{ patient.nom.charAt(0).toUpperCase() }}
                </div>
                <div>
                  <p class="text-[13px] font-medium text-[#1d1d1f]">{{ patient.nom }} {{ patient.prenom }}</p>
                  <p class="text-[11px] text-[#86868b]">{{ patient.email }}</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <p class="text-[13px] text-[#1d1d1f]">{{ patient.num }}</p>
              <p class="text-[11px] text-[#86868b]">{{ patient.addr }}</p>
            </td>
            <td class="px-6 py-4">
              <span class="inline-flex px-2.5 py-1 text-[11px] font-medium rounded-md bg-[#f5f5f7] text-[#1d1d1f]">
                {{ patient.gs }}
              </span>
            </td>
            <td class="px-6 py-4 text-[13px] text-[#86868b]">
              {{ formatDate(patient.daten) }}
            </td>
            <td class="px-6 py-4 text-right">
              <div class="flex justify-end gap-1">
                <a :href="`/patients/${patient.id}/edit`" class="p-2 text-[#0071e3] hover:bg-[#0071e3]/10 rounded-lg transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 011.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
                  </svg>
                </a>
                <button @click="deletePatient(patient.id)" class="p-2 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4H4a1 1 0 00-1 1v1a1 1 0 001 1h16a1 1 0 001-1V5a1 1 0 00-1-1h-5.586"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
          <tr v-if="filteredPatients.length === 0">
            <td colspan="5" class="px-6 py-16 text-center">
              <p class="text-[13px] text-[#86868b]">No patients found</p>
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

const props = defineProps({
  patients: Array
})

const search = ref('')

const filteredPatients = computed(() => {
  if (!search.value) return props.patients
  const query = search.value.toLowerCase()
  return props.patients.filter(p =>
    p.nom.toLowerCase().includes(query) ||
    p.prenom.toLowerCase().includes(query) ||
    p.email.toLowerCase().includes(query)
  )
})

const deletePatient = (id) => {
  if (confirm('Delete this patient?')) {
    router.delete(`/patients/${id}`)
  }
}

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-US')
}
</script>
