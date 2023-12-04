<template>
  <div class="flex justify-center">
    <div class="flex flex-col justify-items-center">
      <object data="/images/logo-anim.svg" style="width: 140px; height: auto; z-index: 10" class="mt-5"/>
      <div v-if="$preLoader.config.loading" class="loader my-10 ml-10"></div>
    </div>

  </div>

</template>

<script setup lang="ts">
import { usePreLoader } from '@/store/system/PreLoader'

const $preLoader = usePreLoader();
</script>

<style scoped>
.loader {
  left: 100px;
  width: 48px;
  height: 48px;
  border: 5px solid #FFF;
  border-bottom-color: #14b8a6;
  border-radius: 50%;
  display: inline-block;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}

@keyframes rotation {
  0% {
      transform: rotate(0deg);
  }
  100% {
      transform: rotate(360deg);
  }
}
</style>
