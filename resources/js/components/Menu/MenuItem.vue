<template>
  <li class="item" v-on:mouseenter="showDropdown" v-on:mouseleave="hideDropdown">
    <a class="item__link" v-bind:href="this.href">{{ this.name }}</a>
    <ul
      class="item__dropdown"
      v-if="this.dropdownVisible"
      v-on:mouseenter="setDropdownHovered(true)"
      v-on:mouseleave="setDropdownHovered(false)"
    >
      <slot></slot>
    </ul>
  </li>
</template>

<style lang="scss">
@import "../../../sass/_variables.scss";

.item {
  background-color: $grey;
  padding: 16px;
  font-weight: bold;
  float: left;

  &__link {
    text-decoration: none;
    color: $white;
  }

  &__dropdown {
    position: absolute;
    display: block;
    list-style: none;
    padding: 0;
    margin-top: 16px;
  }
}
</style>

<script>
export default {
  props: {
    name: String,
    href: String
  },
  data: function() {
    return {
      dropdownVisible: false,
      dropdownHovered: false
    };
  },
  methods: {
    showDropdown: function() {
      this.dropdownVisible = true;
    },
    hideDropdown: function() {
      if (!this.dropdownHovered) {
        this.dropdownVisible = false;
      }
    },
    setDropdownHovered: function(value) {
      this.dropdownHovered = value;
    }
  }
};
</script>