<template>
  <ul class="menu">
    <menu-item name="Home" href="/newsite"></menu-item>
    <menu-item name="Kategorien" href="/"></menu-item>
    <menu-item name="Verkaufen" href="/newsell"></menu-item>
    <menu-item name="Unternehmen" href="/">
      <menu-dropdown-item name="Philosophie" href="/"></menu-dropdown-item>
      <menu-dropdown-item name="Karriere" href="/"></menu-dropdown-item>
    </menu-item>
    <menu-item name="Statistiken" href="/statistics"></menu-item>
    <menu-item name="Tabelle Bespiel" href="/goodtable"></menu-item>
    <menu-item name="Registrierung" href="/register"></menu-item>
    <menu-item name="Login" href="/login"></menu-item>
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
    "menu-dropdown-item": MenuDropdownItem,
  },
};
</script>