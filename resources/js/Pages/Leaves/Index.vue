<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Leave</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.conges.length }} leave(s)</p>
      </div>
      <a href="/conges/create" class="inline-flex items-center gap-2 bg-[#0071e3] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Leave
      </a>
    </div>

    <!-- Leaves List -->
    <div class="space-y-3">
      <div v-for="conge in sortedConges" :key="conge.num_cn" class="bg-white rounded-2xl border border-[#e5e5e7] p-5 hover:shadow-sm transition-shadow group">
        <div class="flex items-start justify-between">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#0071e3]/10 flex items-center justify-center">
              <svg class="w-5 h-5 text-[#0071e3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-[13px] font-medium text-[#1d1d1f]">{{ conge.employee?.nom }} {{ conge.employee?.prenom }}</h3>
              <p class="text-[11px] text-[#86868b]">{{ conge.employee?.fonction || 'N/A' }}</p>
            </div>
          </div>
          <button @click="deleteConge(conge.num_cn)" class="p-1.5 text-[#ff3b30] hover:bg-[#ff3b30]/10 rounded-lg transition-colors opacity-0 group-hover:opacity-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.572a2 2 0 01-1.995 1.924H5.864a2 2 0 01-1.995-1.924L3 7m3 4h6m-3 0a2 2 0 01-2-2h-2a2 2 0 012-2m3 0V3a2 2 0 00-2-2 2 2 0 00-2 2v1"/>
            </svg>
          </button>
        </div>
        <div class="mt-4 pt-3 border-t border-[#e5e5e7] grid grid-cols-3 gap-4 text-[12px]">
          <div class="text-[#86868b]">
            <span class="font-medium text-[#1d1d1f]">From:</span> {{ formatDate(conge.dated) }}
          </div>
          <div class="text-[#86868b]">
            <span class="font-medium text-[#1d1d1f]">To:</span> {{ formatDate(conge.datef) }}
          </div>
          <div class="font-medium" :class="getDurationClass(conge)">
            {{ getDuration(conge) }} days
          </div>
        </div>
      </div>

      <div v-if="props.conges.length === 0" class="bg-white rounded-2xl border border-[#e5e5e7] py-16 text-center">
        <p class="text-[13px] text-[#86868b]">No leave requests found</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  conges: Array
})

const sortedConges = computed(() => {
  return [...props.conges].sort((a, b) => new Date(b.dated) - new Date(a.dated))
})

const deleteConge = (num_cn) => {
  if (confirm('Delete this leave?')) {
    router.delete(`/conges/${num_cn}`)
  }
}

const getDuration = (conge) => {
  return Math.ceil((new Date(conge.datef) - new Date(conge.dated)) / (1000*60*60*24))
}

const getDurationClass = (conge) => {
  const days = getDuration(conge)
  if (days > 14) return 'text-[#ff3b30]'
  if (days > 7) return 'text-[#ff9500]'
  return 'text-[#34c759]'
}

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-US')
}
</script>
