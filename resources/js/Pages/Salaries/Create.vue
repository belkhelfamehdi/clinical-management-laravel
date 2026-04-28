<template>
  <Layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="text-2xl font-bold mb-4">Ajouter un Salaire</h1>
        
        <form @submit.prevent="submit">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Employé</label>
              <select v-model="form.id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                <option value="">Sélectionner un employé</option>
                <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                  {{ employee.nom }} {{ employee.prenom }}
                </option>
              </select>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Salaire (DA)</label>
              <input v-model="form.salaire" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
          </div>
          
          <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Enregistrer
            </button>
            <a href="/salaires" class="ml-4 text-gray-600 hover:text-gray-900">Annuler</a>
          </div>
        </form>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../Layout.vue'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  employees: Array
})

const form = reactive({
  id: '',
  salaire: ''
})

const submit = () => {
  router.post('/salaires', form)
}
</script>
