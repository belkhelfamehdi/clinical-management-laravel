<template>
  <div class="space-y-6 p-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
      <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
      <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
      <div class="relative z-10">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-4xl font-bold mb-2">Tableau de Bord 👋</h1>
            <p class="text-blue-100 text-xl mb-1">Bienvenue, {{ $page.props.auth?.user?.name || 'Admin' }}</p>
            <p class="text-blue-200">{{ new Date().toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }}</p>
          </div>
          <div class="hidden lg:block">
            <div class="w-40 h-40 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border-2 border-white/20">
              <svg class="w-20 h-20 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.076a.6.6 0 0 1 0-.833.667A7.5 7.5 0 0 1 18.667 6.2a.6.6 0 0 1-.833-.667 5.5 5.5 0 0 0-7.066 6.543z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <div v-for="(stat, index) in statCards" :key="index" class="relative group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
        <div class="absolute top-0 left-0 w-full h-1" :class="stat.accent"></div>
        <div class="p-6">
          <div class="flex items-center justify-between mb-4">
            <div :class="['w-14 h-14 rounded-2xl flex items-center justify-center bg-gradient-to-br shadow-lg group-hover:scale-110 transition-transform duration-300', stat.iconBg]">
              <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="stat.icon"/>
              </svg>
            </div>
            <span :class="['text-xs font-medium px-2.5 py-0.5 rounded-full', stat.trendBg, stat.trendColor]">
              +12%
            </span>
          </div>
          <p class="text-3xl font-bold text-gray-900 mb-1">{{ stat.value }}</p>
          <p class="text-sm text-gray-500 font-medium">{{ stat.label }}</p>
        </div>
      </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Quick Actions -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-5 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          Actions Rapides
        </h3>
        <div class="space-y-3">
          <a v-for="action in quickActions" :key="action.label" :href="action.href" class="flex items-center gap-4 p-4 rounded-xl transition-all duration-200 group hover:shadow-md" :class="action.bg">
            <div :class="['w-12 h-12 rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform', action.iconBg]">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="action.icon"/>
              </svg>
            </div>
            <div class="flex-1">
              <p :class="['font-semibold', action.textColor]">{{ action.label }}</p>
              <p class="text-xs text-gray-500">{{ action.desc }}</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Latest Patients -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-5">
          <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Derniers Patients
          </h3>
          <a href="/patients" class="text-sm text-blue-600 hover:underline font-medium">Voir tout</a>
        </div>
        <div class="space-y-3">
          <div v-for="patient in latestPatients" :key="patient.id" class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
            <div class="w-11 h-11 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center text-white font-bold shadow-sm flex-shrink-0">
              {{ patient.nom.charAt(0).toUpperCase() }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-semibold text-gray-900 truncate">{{ patient.nom }} {{ patient.prenom }}</p>
              <p class="text-sm text-gray-500">{{ patient.gs || 'N/A' }} • {{ patient.num || 'N/A' }}</p>
            </div>
            <span class="text-xs text-gray-400 flex-shrink-0">{{ formatDate(patient.created_at) }}</span>
          </div>
          <div v-if="latestPatients.length === 0" class="text-center py-12 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <p class="font-medium">Aucun patient enregistré</p>
          </div>
        </div>
      </div>

      <!-- Latest Employees -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-5">
          <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Derniers Employés
          </h3>
          <a href="/employees" class="text-sm text-blue-600 hover:underline font-medium">Voir tout</a>
        </div>
        <div class="space-y-3">
          <div v-for="employee in latestEmployees" :key="employee.id" class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
            <div class="w-11 h-11 rounded-full bg-gradient-to-br from-purple-400 to-indigo-600 flex items-center justify-center text-white font-bold shadow-sm flex-shrink-0">
              {{ employee.nom.charAt(0).toUpperCase() }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-semibold text-gray-900 truncate">{{ employee.nom }} {{ employee.prenom }}</p>
              <p class="text-sm text-gray-500">{{ employee.fonction || 'N/A' }}</p>
            </div>
            <span class="text-xs text-gray-400 flex-shrink-0">{{ formatDate(employee.created_at) }}</span>
          </div>
          <div v-if="latestEmployees.length === 0" class="text-center py-12 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="font-medium">Aucun employé enregistré</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

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
      iconBg: 'from-blue-500 to-blue-700',
      accent: 'bg-blue-600',
      trendBg: 'bg-blue-50',
      trendColor: 'text-blue-700'
    },
    {
      label: 'Employés',
      value: s.employees || 0,
      icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
      iconBg: 'from-green-500 to-green-700',
      accent: 'bg-green-600',
      trendBg: 'bg-green-50',
      trendColor: 'text-green-700'
    },
    {
      label: 'Chambres',
      value: s.chambres || 0,
      icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
      iconBg: 'from-purple-500 to-purple-700',
      accent: 'bg-purple-600',
      trendBg: 'bg-purple-50',
      trendColor: 'text-purple-700'
    },
    {
      label: 'Revenu (DA)',
      value: s.revenue || 0,
      icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zm0 0c1.657 0 3-.895 3-2s-1.343-2-3-2-3 .895-3 2 1.343 2 3 2zm0 6v1m0 0v1m0-1h1m-1 0h-1',
      iconBg: 'from-yellow-500 to-yellow-700',
      accent: 'bg-yellow-600',
      trendBg: 'bg-yellow-50',
      trendColor: 'text-yellow-700'
    }
  ]
})

const quickActions = [
  {
    label: 'Nouveau Patient',
    desc: 'Enregistrer un nouveau patient',
    href: '/patients',
    icon: 'M12 4v16m8-8H4',
    bg: 'bg-blue-50 hover:bg-blue-100',
    iconBg: 'bg-blue-600',
    textColor: 'text-blue-700'
  },
  {
    label: 'Prendre RDV',
    desc: 'Planifier un rendez-vous',
    href: '/appointments',
    icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
    bg: 'bg-green-50 hover:bg-green-100',
    iconBg: 'bg-green-600',
    textColor: 'text-green-700'
  },
  {
    label: 'Gérer Stock',
    desc: 'Mise à jour pharmacie',
    href: '/medicaments',
    icon: 'M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z',
    bg: 'bg-purple-50 hover:bg-purple-100',
    iconBg: 'bg-purple-600',
    textColor: 'text-purple-700'
  }
]

const formatDate = (date) => {
  if (!date) return ''
  const d = new Date(date)
  const now = new Date()
  const diff = Math.floor((now - d) / (1000 * 60 * 60 * 24))
  if (diff === 0) return 'Aujourd\'hui'
  if (diff === 1) return 'Hier'
  if (diff < 7) return `Il y a ${diff}j`
  return d.toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' })
}
</script>
