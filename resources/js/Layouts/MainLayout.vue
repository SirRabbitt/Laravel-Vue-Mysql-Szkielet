<template>
    
      
    
    <Link href="/">main Page</Link>&nbsp;
    <Link href="/hello">Show Page</Link>
    <h1>Welcome {{ counter }}</h1>
    <slot></slot>


  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3'
  import {ref} from 'vue'

  const counter = ref(0)
  setInterval(()=> counter.value++, 1000)
  </script>
  