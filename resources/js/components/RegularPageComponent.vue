<template>
    <div class="main-container">
      <RegularNavBar />
      <UsernameViewComponent />
    </div>
</template>

<script>
import RegularNavBar from './RegularNavBar.vue'
import UsernameViewComponent from './UsernameViewComponent';

export default {
  components: {
    'RegularNavBar': RegularNavBar,
    'UsernameViewComponent': UsernameViewComponent                                                
  }
}
</script>

<style>

</style>