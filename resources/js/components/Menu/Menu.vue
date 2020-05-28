<template>
  <ul class="menu">
    <menu-item name="Home" href="/"></menu-item>
    <menu-item name="Kategorien" href="/"></menu-item>
    <menu-item name="Verkaufen" href="sell"></menu-item>
    <menu-item name="Unternehmen" href="/">
      <menu-dropdown-item name="Philosophie" href="/"></menu-dropdown-item>
      <menu-dropdown-item name="Karriere" href="/"></menu-dropdown-item>
    </menu-item>
  </ul>
</template>

<style lang="scss">
.menu {
  list-style: none;
  padding-bottom: 50px;
  padding-left: 0;
}
</style>

<script>
import MenuItem from "./MenuItem.vue";
import MenuDropdownItem from "./MenuDropdownItem.vue";

export default {
  components: {
    "menu-item": MenuItem,
    "menu-dropdown-item": MenuDropdownItem
  }
};
</script>