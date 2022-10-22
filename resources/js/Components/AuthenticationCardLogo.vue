<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import icon from '../../images/favicon-32x32.png'
</script>

<template>
    <Link :href="'/'">
      <img class="rounded-md w-14 " :src="icon">
    </Link>
</template>
