<template>
  <div class="min-h-screen bg-[#f5f5f7] flex">
    <aside class="w-[260px] h-screen bg-white/80 backdrop-blur-xl border-r border-[#e5e5e7] flex flex-col flex-shrink-0 sticky top-0">
      <div class="h-[72px] flex items-center px-6 border-b border-[#e5e5e7]">
        <div class="flex items-center gap-3">
          <img src="/images/logo.png" class="w-14 h-14 object-contain" alt="Logo">
          <span class="text-lg font-semibold text-[#1d1d1f] tracking-tight">ONE HEALTH</span>
        </div>
      </div>

      <nav class="flex-1 overflow-y-auto py-5 px-3">
        <div class="space-y-1">
          <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
          </a>

          <a href="/patients" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/patients') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Patients
          </a>

          <a href="/employees" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/employees') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Employees
          </a>

          <a href="/medicaments" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/medicaments') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.147-4.295a2 2 0 00-1.022-1.127V8.5a4 4 0 00-8 0v.999a2 2 0 00-1.022 1.127L3.594 14.88a2 2 0 00-1.022.547 8.003 8.003 0 0015.835 1.999A8.002 8.002 0 0019.428 15.428z"/>
            </svg>
            Pharmacy
          </a>

          <a href="/chambres" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/chambres') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 001 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Rooms
          </a>

          <a href="/donneurs" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/donneurs') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            Blood Bank
          </a>

          <a href="/factures" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/factures') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14v6H3m0 0l9-9 4 4m5-5a2.121 2.121 0 000-3l-1-1a2.121 2.121 0 00-3 0l-2 2"/>
            </svg>
            Invoices
          </a>

          <a href="/rendez-vous" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/rendez-vous') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Appointments
          </a>

          <a href="/conges" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/conges') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Leave
          </a>

          <a href="/salaires" class="flex items-center gap-3 px-3 py-2.5 text-[13px] font-medium rounded-lg transition-all duration-200" :class="isActive('/salaires') ? 'bg-[#0071e3]/10 text-[#0071e3]' : 'text-[#6e6e73] hover:bg-[#f5f5f7] hover:text-[#1d1d1f]'">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zm0 0c1.657 0 3-.895 3-2s-1.343-2-3-2-3 .895-3 2 1.343 2 3 2zm0 6v1m0 0v1m0-1h1m-1 0h-1"/>
            </svg>
            Salaries
          </a>
        </div>
      </nav>

      <div class="border-t border-[#e5e5e7] p-4 mt-auto">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-9 h-9 rounded-full bg-[#0071e3] flex items-center justify-center text-white text-sm font-medium flex-shrink-0">
            {{ $page.props.auth?.user?.name?.charAt(0).toUpperCase() || '?' }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-[13px] font-medium text-[#1d1d1f] truncate">{{ $page.props.auth?.user?.name || 'User' }}</p>
            <p class="text-[11px] text-[#86868b] truncate">{{ $page.props.auth?.user?.email || '' }}</p>
          </div>
        </div>
        <form @submit.prevent="router.post('/logout')">
          <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 text-[13px] font-medium text-white bg-[#ff3b30] rounded-lg hover:bg-[#ff453a] transition-colors">
            <svg class="w-[15px] h-[15px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Sign Out
          </button>
        </form>
      </div>
    </aside>

    <main class="flex-1 overflow-y-auto">
      <div class="max-w-[1200px] mx-auto py-8 px-8">
        <slot />
      </div>
    </main>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const isActive = (path) => {
  return window.location.pathname === path
}
</script>
