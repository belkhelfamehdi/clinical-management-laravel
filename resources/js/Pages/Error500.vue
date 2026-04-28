<script setup>
import Layout from './Layout.vue'
import { Head } from '@inertiajs/vue3'

defineOptions({ layout: Layout })
</script>

<template>
  <Head title="500 - Server Error" />
  <div class="min-h-[60vh] flex items-center justify-center">
    <div class="text-center">
      <h1 class="text-9xl font-bold text-gray-300">500</h1>
      <h2 class="text-3xl font-semibold text-gray-700 mt-4">Server Error</h2>
      <p class="text-gray-500 mt-2">Something went wrong on our end.</p>
      <a
        href="/"
        class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
      >
        Go Back Home
      </a>
    </div>
  </div>
</template>
