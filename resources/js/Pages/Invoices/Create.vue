<template>
  <Layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="text-2xl font-bold mb-4">Créer une Facture</h1>
        
        <form @submit.prevent="submit">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Patient</label>
              <select v-model="form.id_p" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                <option value="">Sélectionner un patient</option>
                <option v-for="patient in patients" :key="patient.id" :value="patient.id">
                  {{ patient.nom }} {{ patient.prenom }}
                </option>
              </select>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Montant</label>
              <input v-model="form.Montant" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="0">
            </div>
          </div>
          
          <div class="mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
              Enregistrer
            </button>
            <a href="/factures" class="ml-4 text-gray-600 hover:text-gray-900">Annuler</a>
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
  patients: Array
})

const form = reactive({
  id_p: '',
  Montant: 0
})

const submit = () => {
  router.post('/factures', form)
}
</script>
