<template>
  <div class="min-h-screen bg-[#f5f5f7] flex items-center justify-center p-6">
    <div class="w-full max-w-sm">
      <!-- Logo -->
      <div class="text-center mb-10">
        <img src="/images/logo.png" class="w-20 h-20 object-contain mx-auto mb-5" alt="Logo">
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Create Account</h1>
        <p class="text-[13px] text-[#86868b] mt-2">Get started with ONE HEALTH</p>
      </div>

      <!-- Form -->
      <div class="bg-white rounded-2xl border border-[#e5e5e7] p-6">
        <form @submit.prevent="submit">
          <div class="space-y-4">
            <div>
              <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Name</label>
              <input v-model="form.name" type="text" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] placeholder-[#86868b] outline-none focus:ring-2 focus:ring-[#0071e3]/20" placeholder="Your name" required>
            </div>

            <div>
              <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Email</label>
              <input v-model="form.email" type="email" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] placeholder-[#86868b] outline-none focus:ring-2 focus:ring-[#0071e3]/20" placeholder="your@email.com" required>
            </div>

            <div>
              <label class="block text-[13px] font-medium text-[#1d1d1f] mb-2">Password</label>
              <input v-model="form.password" type="password" class="w-full px-4 py-2.5 bg-[#f5f5f7] border-0 rounded-lg text-[13px] text-[#1d1d1f] placeholder-[#86868b] outline-none focus:ring-2 focus:ring-[#0071e3]/20" placeholder="••••••••" required>
            </div>

            <div v-if="errors.email" class="p-3 bg-[#ff3b30]/10 text-[#ff3b30] text-[13px] rounded-lg">
              {{ errors.email }}
            </div>

            <button type="submit" class="w-full bg-[#0071e3] text-white py-2.5 rounded-lg text-[13px] font-medium hover:bg-[#0077ed] transition-colors">
              Create Account
            </button>
          </div>
        </form>
      </div>

      <p class="mt-6 text-center text-[13px] text-[#86868b]">
        Already have an account?
        <a href="/login" class="text-[#0071e3] hover:underline font-medium">Sign in</a>
      </p>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({
  errors: { type: Object, default: () => ({}) }
})

const form = useForm({
  name: '',
  email: '',
  password: ''
})

const submit = () => {
  form.post('/register')
}
</script>
