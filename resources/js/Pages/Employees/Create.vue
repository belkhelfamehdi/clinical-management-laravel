<template>
  <Layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="text-2xl font-bold mb-4">Ajouter un Employé</h1>
        
        <form @submit.prevent="submit">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Nom</label>
              <input v-model="form.nom" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Prénom</label>
              <input v-model="form.prenom" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Date de naissance</label>
              <input v-model="form.daten" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Date d'embauche</label>
              <input v-model="form.dateem" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Genre</label>
              <select v-model="form.gen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                <option value="">Sélectionner</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
              </select>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Téléphone</label>
              <input v-model="form.num" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Email</label>
              <input v-model="form.email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Fonction</label>
              <input v-model="form.fonction" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Médecin, Infirmier, etc.">
            </div>
          </div>
          
          <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Enregistrer
            </button>
            <a href="/employees" class="ml-4 text-gray-600 hover:text-gray-900">Annuler</a>
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

const form = reactive({
  nom: '',
  prenom: '',
  daten: '',
  dateem: '',
  gen: '',
  num: '',
  email: '',
  fonction: ''
})

const submit = () => {
  router.post('/employees', form)
}
</script>
