<template>
  <Layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="text-2xl font-bold mb-4">Modifier le Médicament</h1>
        
        <form @submit.prevent="submit">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Nom</label>
              <input v-model="form.nom" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Quantité</label>
              <input v-model="form.quantite" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="0">
            </div>
          </div>
          
          <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Mettre à jour
            </button>
            <a href="/medicaments" class="ml-4 text-gray-600 hover:text-gray-900">Annuler</a>
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

const props = defineProps({
  medicament: Object
})

const form = reactive({
  nom: props.medicament.nom,
  quantite: props.medicament.quantite
})

const submit = () => {
  router.put(`/medicaments/${props.medicament.numM}`, form)
}
</script>
