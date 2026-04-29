<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Pharmacy</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.medicaments.length }} medication(s)</p>
      </div>
      <a href="/medicaments/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Medication
      </a>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-2xl border border-[#e5e5e7] p-4 mb-6">
      <input type="text" v-model="search" placeholder="Search medications..." class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] placeholder-[#86868b] outline-none focus:ring-2 focus:ring-[#0071e3]/20">
    </div>

    <!-- Grid View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      <div v-for="med in filteredMedicaments" :key="med.numM" class="bg-white rounded-2xl border border-[#e5e5e7] p-5 hover:shadow-sm transition-shadow group">
        <div class="flex items-start justify-between mb-4">
          <div class="w-10 h-10 rounded-xl bg-[#af52de]/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-[#af52de]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z"/>
            </svg>
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <a :href="`/medicaments/${med.numM}/edit`" class="p-1.5 text-[#0071e3] hover:bg-[#0071e3]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 011.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
              </svg>
            </a>
            <button @click="deleteMedicament(med.numM)" class="p-1.5 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4H4a1 1 0 00-1 1v1a1 1 0 001 1h14a1 1 0 001-1V5a1 1 0 00-1-1h-5.586"/>
              </svg>
            </button>
          </div>
        </div>
        <h3 class="text-[13px] font-medium text-[#1d1d1f] mb-2">{{ med.nom }}</h3>
        <span class="inline-flex px-2.5 py-1 text-[11px] font-medium rounded-md" :class="med.quantite > 50 ? 'bg-[#34c759]/10 text-[#34c759]' : med.quantite > 0 ? 'bg-[#ff9500]/10 text-[#ff9500]' : 'bg-[#ff3b30]/10 text-[#ff3b30]'">
          {{ med.quantite }} in stock
        </span>
      </div>

      <div v-if="filteredMedicaments.length === 0" class="col-span-full">
        <div class="bg-white rounded-2xl border border-[#e5e5e7] py-16 text-center">
          <p class="text-[13px] text-[#86868b]">No medications found</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  medicaments: Array
})

const search = ref('')

const filteredMedicaments = computed(() => {
  if (!search.value) return props.medicaments
  const query = search.value.toLowerCase()
  return props.medicaments.filter(m => m.nom.toLowerCase().includes(query))
})

const deleteMedicament = (numM) => {
  if (confirm('Delete this medication?')) {
    router.delete(`/medicaments/${numM}`)
  }
}
</script>
