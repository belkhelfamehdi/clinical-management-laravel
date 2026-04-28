<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
      <div class="text-center mb-8">
        <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Connexion</h1>
        <p class="mt-2 text-gray-600">Accédez à votre espace médical</p>
      </div>
     
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input v-model="form.email" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="votre@email.com" required>
        </div>
        
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
          <input v-model="form.password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="••••••••" required>
        </div>
        
        <div v-if="errors.email" class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded-lg">
          {{ errors.email }}
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-xl hover:bg-blue-700 font-medium transition">
          Se connecter
        </button>
      </form>
     
      <p class="mt-6 text-center text-sm text-gray-600">
        Vous n'avez pas de compte? 
        <a href="/register" class="text-blue-600 hover:underline font-medium">S'inscrire</a>
      </p>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  errors: { type: Object, default: () => ({}) }
})

const form = reactive({
  email: '',
  password: ''
})

const submit = () => {
  router.post('/login', form)
}
</script>
