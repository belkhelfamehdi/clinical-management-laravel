<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Appointments</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.rendezvous.length }} appointment(s)</p>
      </div>
      <a href="/rendez-vous/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Appointment
      </a>
    </div>

    <!-- Timeline View -->
    <div class="space-y-4">
      <div v-for="rdv in sortedRendezVous" :key="rdv.num" class="bg-white rounded-2xl border border-[#e5e5e7] p-5 hover:shadow-sm transition-shadow">
        <div class="flex items-start gap-4">
          <!-- Date Badge -->
          <div class="flex-shrink-0 w-14 text-center bg-[#f5f5f7] rounded-xl py-3">
            <div class="text-xl font-semibold text-[#1d1d1f]">{{ getDay(rdv.date) }}</div>
            <div class="text-[11px] text-[#86868b] uppercase">{{ getMonth(rdv.date) }}</div>
          </div>

          <!-- Content -->
          <div class="flex-1">
            <div class="flex items-center justify-between mb-2">
              <div>
                <h3 class="text-[13px] font-medium text-[#1d1d1f]">
                  {{ rdv.patient?.nom }} {{ rdv.patient?.prenom }}
                </h3>
                <p class="text-[11px] text-[#86868b]">
                  Dr. {{ rdv.doctor?.nom }} {{ rdv.doctor?.prenom }}
                </p>
              </div>
              <span class="inline-flex px-2.5 py-1 text-[11px] font-medium rounded-md" :class="rdv.status === 'confirmé' ? 'bg-[#34c759]/10 text-[#34c759]' : 'bg-[#ff9500]/10 text-[#ff9500]'">
                {{ rdv.status || 'Pending' }}
              </span>
            </div>
          </div>

          <!-- Actions -->
          <button @click="deleteRdv(rdv.num)" class="p-1.5 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 112 0zM7 10a2 2 0 112 0z"/>
            </svg>
          </button>
        </div>
      </div>

      <div v-if="props.rendezvous.length === 0" class="bg-white rounded-2xl border border-[#e5e5e7] py-16 text-center">
        <p class="text-[13px] text-[#86868b]">No appointments scheduled</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  rendezvous: Array
})

const sortedRendezVous = computed(() => {
  return [...props.rendezvous].sort((a, b) => new Date(b.date) - new Date(a.date))
})

const deleteRdv = (num) => {
  if (confirm('Delete this appointment?')) {
    router.delete(`/rendez-vous/${num}`)
  }
}

const getDay = (date) => {
  if (!date) return ''
  return new Date(date).getDate()
}

const getMonth = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-US', { month: 'short' })
}
</script>
