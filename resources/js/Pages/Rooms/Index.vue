<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Rooms</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.chambres.length }} room(s)</p>
      </div>
      <a href="/chambres/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Room
      </a>
    </div>

    <!-- Grid View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      <div v-for="ch in props.chambres" :key="ch.num" class="bg-white rounded-2xl border border-[#e5e5e7] p-5 hover:shadow-sm transition-shadow group">
        <div class="flex items-start justify-between mb-4">
          <div class="w-10 h-10 rounded-xl bg-[#0071e3]/10 flex items-center justify-center text-[#0071e3] text-sm font-semibold">
            {{ ch.num }}
          </div>
          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <a :href="`/chambres/${ch.num}/edit`" class="p-1.5 text-[#0071e3] hover:bg-[#0071e3]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 011.414-1.414L11 10.586V7a2 2 0 012-2h5"/>
              </svg>
            </a>
            <button @click="deleteChambre(ch.num)" class="p-1.5 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4H4a1 1 0 00-1 1v1a1 1 0 001 1h14a1 1 0 001-1V5a1 1 0 00-1-1h-5.586"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="space-y-2 pt-3 border-t border-[#e5e5e7]">
          <div class="flex items-center gap-2 text-[12px] text-[#86868b]">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            {{ ch.patient ? ch.patient.nom + ' ' + ch.patient.prenom : 'Available' }}
          </div>
        </div>
      </div>

      <div v-if="props.chambres.length === 0" class="col-span-full">
        <div class="bg-white rounded-2xl border border-[#e5e5e7] py-16 text-center">
          <p class="text-[13px] text-[#86868b]">No rooms found</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
  chambres: Array
})

const deleteChambre = (num) => {
  if (confirm('Delete this room?')) {
    router.delete(`/chambres/${num}`)
  }
}
</script>
