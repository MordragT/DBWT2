<template>
  <li class="dropdown">
    <a class="dropdown__link" v-bind:href="this.href">{{ this.name }}</a>
  </li>
</template>

<style lang="scss">
@import "../../../sass/variables";

.dropdown {
  background-color: $grey;
  padding: 16px;

  &__link {
    text-decoration: none;
    color: $white;
  }
}
</style>

<script>
export default {
  props: {
    name: String,
    href: String
  }
};
</script>
