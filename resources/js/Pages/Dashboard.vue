<template>
  <div>
    <div class="mb-8">
      <h1 class="text-2xl font-semibold text-[#1d1d1f]">Dashboard</h1>
      <p class="text-[13px] text-[#86868b] mt-1">{{ $page.props.auth?.user?.name || 'Welcome back' }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <div v-for="(stat, index) in statCards" :key="index" class="bg-white rounded-2xl p-5 border border-[#e5e5e7] hover:shadow-sm transition-shadow">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl flex items-center justify-center" :class="stat.bg">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="stat.icon"/>
            </svg>
          </div>
        </div>
        <p class="text-2xl font-semibold text-[#1d1d1f]">{{ stat.value }}</p>
        <p class="text-[13px] text-[#86868b] mt-0.5">{{ stat.label }}</p>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="bg-white rounded-2xl border border-[#e5e5e7] p-6">
        <h3 class="text-[15px] font-semibold text-[#1d1d1f] mb-5">Quick Actions</h3>
        <div class="space-y-2">
          <a v-for="action in quickActions" :key="action.label" :href="action.href" class="flex items-center gap-3 p-3 rounded-xl transition-all duration-200 hover:bg-[#f5f5f7]">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center" :class="action.bg">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="action.icon"/>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-[13px] font-medium text-[#1d1d1f]">{{ action.label }}</p>
              <p class="text-[11px] text-[#86868b]">{{ action.desc }}</p>
            </div>
            <svg class="w-4 h-4 text-[#c2c2c4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-[#e5e5e7] p-6">
        <div class="flex items-center justify-between mb-5">
          <h3 class="text-[15px] font-semibold text-[#1d1d1f]">Latest Patients</h3>
          <a href="/patients" class="text-[13px] text-[#0071e3] hover:underline font-medium">View all</a>
        </div>
        <div class="space-y-3">
          <div v-for="patient in latestPatients" :key="patient.id" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-[#f5f5f7] transition-colors">
            <div class="w-9 h-9 rounded-full bg-[#0071e3]/10 flex items-center justify-center text-[#0071e3] text-sm font-medium flex-shrink-0">
              {{ patient.nom.charAt(0).toUpperCase() }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-[13px] font-medium text-[#1d1d1f] truncate">{{ patient.nom }} {{ patient.prenom }}</p>
              <p class="text-[11px] text-[#86868b]">{{ patient.gs || 'N/A' }}</p>
            </div>
          </div>
          <div v-if="latestPatients.length === 0" class="text-center py-8 text-[#86868b]">
            <p class="text-[13px]">No patients yet</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl border border-[#e5e5e7] p-6">
        <div class="flex items-center justify-between mb-5">
          <h3 class="text-[15px] font-semibold text-[#1d1d1f]">Latest Employees</h3>
          <a href="/employees" class="text-[13px] text-[#0071e3] hover:underline font-medium">View all</a>
        </div>
        <div class="space-y-3">
          <div v-for="employee in latestEmployees" :key="employee.id" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-[#f5f5f7] transition-colors">
            <div class="w-9 h-9 rounded-full bg-[#34c759]/10 flex items-center justify-center text-[#34c759] text-sm font-medium flex-shrink-0">
              {{ employee.nom.charAt(0).toUpperCase() }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-[13px] font-medium text-[#1d1d1f] truncate">{{ employee.nom }} {{ employee.prenom }}</p>
              <p class="text-[11px] text-[#86868b]">{{ employee.fonction || 'N/A' }}</p>
            </div>
          </div>
          <div v-if="latestEmployees.length === 0" class="text-center py-8 text-[#86868b]">
            <p class="text-[13px]">No employees yet</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  stats: Object,
  latestPatients: Array,
  latestEmployees: Array
})

const statCards = computed(() => {
  const s = props.stats || {}
  return [
    {
      label: 'Patients',
      value: s.patients || 0,
      icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
      bg: 'bg-[#0071e3]'
    },
    {
      label: 'Employees',
      value: s.employees || 0,
      icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
      bg: 'bg-[#34c759]'
    },
    {
      label: 'Rooms',
      value: s.chambres || 0,
      icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
      bg: 'bg-[#ff9500]'
    },
    {
      label: 'Revenue (DA)',
      value: s.revenue || 0,
      icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zm0 0c1.657 0 3-.895 3-2s-1.343-2-3-2-3 .895-3 2 1.343 2 3 2zm0 6v1m0 0v1m0-1h1m-1 0h-1',
      bg: 'bg-[#af52de]'
    }
  ]
})

const quickActions = [
  {
    label: 'New Patient',
    desc: 'Register a new patient',
    href: '/patients/create',
    icon: 'M12 4v16m8-8H4',
    bg: 'bg-[#0071e3]'
  },
  {
    label: 'New Appointment',
    desc: 'Schedule an appointment',
    href: '/rendez-vous/create',
    icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
    bg: 'bg-[#34c759]'
  },
  {
    label: 'Manage Stock',
    desc: 'Update pharmacy inventory',
    href: '/medicaments/create',
    icon: 'M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z',
    bg: 'bg-[#ff9500]'
  }
]
</script>
