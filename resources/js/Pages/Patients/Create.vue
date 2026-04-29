<template>
  <div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">New Patient</h1>
        <p class="text-[13px] text-[#86868b] mt-1">Register a new patient</p>
      </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl border border-[#e5e5e7] p-8">
      <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Last Name</label>
            <input v-model="form.nom" type="text" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">First Name</label>
            <input v-model="form.prenom" type="text" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Date of Birth</label>
            <input v-model="form.daten" type="date" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Gender</label>
            <select v-model="form.gen" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
              <option value="">Select</option>
              <option value="Homme">Male</option>
              <option value="Femme">Female</option>
            </select>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Phone</label>
            <input v-model="form.num" type="text" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Email</label>
            <input v-model="form.email" type="email" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>

          <div class="md:col-span-2">
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Address</label>
            <input v-model="form.addr" type="text" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Blood Type</label>
            <select v-model="form.gs" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
              <option value="">Select</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>
          </div>
        </div>

        <div class="flex items-center gap-3 mt-8 pt-6 border-t border-[#e5e5e7]">
          <button type="submit" class="bg-[#0071e3] text-white px-5 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
            Save
          </button>
          <a href="/patients" class="text-[13px] text-[#86868b] hover:text-[#1d1d1f] transition-colors font-medium">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
  nom: '',
  prenom: '',
  daten: '',
  gen: '',
  num: '',
  email: '',
  addr: '',
  gs: ''
})

const submit = () => {
  router.post('/patients', form)
}
</script>
