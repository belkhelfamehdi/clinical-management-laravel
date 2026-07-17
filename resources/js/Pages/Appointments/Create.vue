<template>
  <div>
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">New Appointment</h1>
        <p class="text-[13px] text-[#86868b] mt-1">Schedule a new appointment</p>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-[#e5e5e7] p-8">
      <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Patient</label>
            <select v-model="form.id_p" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
              <option value="" disabled>Select a patient</option>
              <option v-for="patient in patients" :key="patient.id" :value="patient.id">
                {{ patient.nom }} {{ patient.prenom }}
              </option>
            </select>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Doctor</label>
            <select v-model="form.id_e" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
              <option value="" disabled>Select a doctor</option>
              <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
                Dr. {{ doctor.nom }} {{ doctor.prenom }}
              </option>
            </select>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Date</label>
            <input v-model="form.date" type="date" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>
        </div>

        <div class="flex items-center gap-3 mt-8 pt-6 border-t border-[#e5e5e7]">
          <button type="submit" class="bg-[#0071e3] text-white px-5 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
            Save
          </button>
          <a href="/rendez-vous" class="text-[13px] text-[#86868b] hover:text-[#1d1d1f] transition-colors font-medium">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  patients: Array,
  doctors: Array
})

const form = reactive({
  id_p: '',
  id_e: '',
  date: ''
})

const submit = () => {
  router.post('/rendez-vous', form)
}
</script>
