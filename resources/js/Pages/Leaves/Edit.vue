<template>
  <div>
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Edit Leave</h1>
        <p class="text-[13px] text-[#86868b] mt-1">Update leave request</p>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-[#e5e5e7] p-8">
      <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Employee</label>
            <select v-model="form.id_em" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
              <option value="" disabled>Select an employee</option>
              <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                {{ employee.nom }} {{ employee.prenom }}
              </option>
            </select>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Start Date</label>
            <input v-model="form.dated" type="date" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>

          <div>
            <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">End Date</label>
            <input v-model="form.datef" type="date" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#0071e3]/20" required>
          </div>
        </div>

        <div class="flex items-center gap-3 mt-8 pt-6 border-t border-[#e5e5e7]">
          <button type="submit" class="bg-[#0071e3] text-white px-5 py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
            Update
          </button>
          <a href="/conges" class="text-[13px] text-[#86868b] hover:text-[#1d1d1f] transition-colors font-medium">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  conge: Object,
  employees: Array
})

const form = reactive({
  id_em: props.conge.id_em,
  dated: props.conge.dated,
  datef: props.conge.datef
})

const submit = () => {
  router.put(`/conges/${props.conge.num_cn}`, form)
}
</script>
