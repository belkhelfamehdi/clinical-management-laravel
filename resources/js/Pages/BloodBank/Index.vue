<template>
  <div>
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Blood Bank</h1>
        <p class="text-[13px] text-[#86868b] mt-1">{{ props.donneurs.length }} donor(s)</p>
      </div>
      <a href="/donneurs/create" class="inline-flex items-center gap-2 bg-[#ff2d55] text-white px-4 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#ff3b5f] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Donor
      </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
      <div v-for="stock in props.stocks" :key="stock.gs" class="bg-white rounded-2xl border border-[#e5e5e7] p-5 text-center">
        <div class="text-2xl font-semibold" :class="stock.quantite > 20 ? 'text-[#34c759]' : stock.quantite > 10 ? 'text-[#ff9500]' : 'text-[#ff3b30]'">
          {{ stock.quantite }}
        </div>
        <div class="text-[11px] text-[#86868b] mt-1 font-medium">{{ stock.gs }}</div>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-[#e5e5e7] overflow-hidden">
      <table class="min-w-full divide-y divide-[#e5e5e7]">
        <thead class="bg-[#fafafa]">
          <tr>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Donor</th>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Contact</th>
            <th class="px-6 py-3.5 text-left text-[11px] font-medium text-[#86868b] uppercase tracking-wider">Blood Type</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-[#e5e5e7]">
          <tr v-for="donneur in props.donneurs" :key="donneur.id" class="hover:bg-[#fafafa] transition-colors">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[#ff2d55]/10 flex items-center justify-center text-[#ff2d55] text-sm font-medium flex-shrink-0">
                  {{ donneur.nom.charAt(0).toUpperCase() }}
                </div>
                <div>
                  <p class="text-[13px] font-medium text-[#1d1d1f]">{{ donneur.nom }} {{ donneur.prenom }}</p>
                  <p class="text-[11px] text-[#86868b]">{{ donneur.numero }}</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <p class="text-[13px] text-[#86868b]">{{ donneur.email || 'N/A' }}</p>
            </td>
            <td class="px-6 py-4">
              <span class="inline-flex px-2.5 py-1 text-[11px] font-medium rounded-md bg-[#ff2d55]/10 text-[#ff2d55]">
                {{ donneur.gs }}
              </span>
            </td>
          </tr>
          <tr v-if="props.donneurs.length === 0">
            <td colspan="3" class="px-6 py-16 text-center">
              <p class="text-[13px] text-[#86868b]">No donors found</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  stocks: Array,
  donneurs: Array
})
</script>
