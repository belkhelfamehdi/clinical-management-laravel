<template>
  <div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col flex-shrink-0">
      <!-- Logo -->
      <div class="h-16 flex items-center px-6 border-b border-gray-100">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-md">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.26 10.076a.6.6 0 0 1 0-.833.667A7.5 7.5 0 0 1 18.667 6.2a.6.6 0 0 1-.833-.667 5.5 5.5 0 0 0-7.066 6.543z"/>
            </svg>
          </div>
          <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">ONE HEALTH</span>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 overflow-y-auto py-4 px-3">
        <div class="space-y-1">
          <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
          </a>

          <a href="/patients" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/patients') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Patients
          </a>

          <a href="/employees" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/employees') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Employés
          </a>

          <a href="/medicaments" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/medicaments') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z"/>
            </svg>
            Pharmacie
          </a>

          <a href="/chambres" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/chambres') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Chambres
          </a>

          <a href="/donneurs" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/donneurs') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z"/>
            </svg>
            Banque de Sang
          </a>

          <a href="/factures" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/factures') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Factures
          </a>

          <a href="/appointments" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/appointments') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Rendez-vous
          </a>

          <a href="/conges" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/conges') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Congés
          </a>

          <a href="/salaries" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200" :class="isActive('/salaries') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-gray-100'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zm0 12a6 6 0 01-6-6v-2a6 6 0 0112 0v2a6 6 0 01-6 6z"/>
            </svg>
            Salaires
          </a>
        </div>
      </nav>

      <!-- User Menu -->
      <div class="border-t border-gray-100 p-4">
        <template v-if="$page.props.auth?.user">
          <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold shadow-md">
              {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-gray-900 truncate">{{ $page.props.auth.user.name }}</p>
              <p class="text-xs text-gray-500 truncate">{{ $page.props.auth.user.email }}</p>
            </div>
          </div>
          <form @submit.prevent="router.post('/logout')">
            <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-600 rounded-xl hover:bg-red-50 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              Déconnexion
            </button>
          </form>
        </template>
        <template v-else>
          <div class="space-y-2">
            <a href="/login" class="block w-full px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-colors">
              Connexion
            </a>
            <a href="/register" class="block w-full px-3 py-2.5 text-sm font-medium text-center text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
              Inscription
            </a>
          </div>
        </template>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto bg-gray-50">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const isDashboard = computed(() => {
  return window.location.pathname === '/' || window.location.pathname === '/dashboard'
})

const isActive = (path) => {
  return window.location.pathname === path
}
</script>
