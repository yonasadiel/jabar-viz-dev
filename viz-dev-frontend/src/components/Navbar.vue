<template>
    <ul class="nav__top">
        <li v-for="link in links">
            <a href="#"> {{ link }} </a>
        </li>
    </ul>
</template>

<script>
export default {
  data() {
    return {
      links: ['Data Viz', 'Edit', 'Username!'],
    };
  },
};
</script>

<style scoped>
/* Navigation Bar */
.nav__top {
    margin: 0;
    padding: 0;
    list-style-type: none;
    overflow: hidden;
    background-color: rgba(6, 116, 210, 1);
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    cursor: pointer;
    text-decoration: none;
}

li a:hover {
    background-color: rgba(255, 255, 255, .3);
}

#username {
    float: right;
}
</style>
