<!-- eslint-disable no-unused-vars -->
<template>
  <div>Index</div>
  <Link href="/hello">
    Show Page
  </Link>
  <div>The message is {{ message }}</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
// eslint-disable-next-line no-unused-vars
const props = defineProps({
  message: String,
})

</script>