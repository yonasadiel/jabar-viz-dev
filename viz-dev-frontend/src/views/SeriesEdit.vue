<template>
  <div>
    <Navbar></Navbar>
    <div class="container">
        <div class="header">
            <h1>JABAR DATA VISUALIZATION</h1>
            <h2>{{this.$route.query.data}}</h2>
        </div>
        <div class="container__edit">
            <div class="flex-row">
                <div class="flex-col col-header">
                    <div class="row-header">Kab / Kota</div>
                    <div class="row-entry" v-for="kota in kab_kota">{{kota.name}}</div>
                </div>
                <div class="flex-col col-entry">
                    <div class="row-header">2016</div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.2"></div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.3"></div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.4"></div>
                </div>
                <div class="flex-col col-entry">
                    <div class="row-header">2017</div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.2"></div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.3"></div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.4"></div>
                </div>
                <div class="flex-col col-entry">
                    <div class="row-header">2018</div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.2"></div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.3"></div>
                    <div class="row-entry"><input type="text" class="number-entry" value="1.4"></div>
                </div>
            </div>
            <button class="btn__save">SAVE</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SeriesEdit',
  components: {
  },
  data() {
    return {
      kab_kota: [
        { name: 'Kota Bandung' },
        { name: 'Kota Bekasi' },
        { name: 'Kota Depok' },
      ],
    };
  },
};
</script>

<style scoped>
.flex-row {
    display: flex;
    flex-direction: row;
}

.flex-col {
    display: flex;
    flex-direction: column;
}
/* container */
.container {
    padding: 40px 76px;
}

/* header */
.header {
    text-align: center;
}

/* flex container */
.grid__edit--form {
    display: grid;
    grid-template-columns: auto auto auto auto auto auto auto;
    padding: 10px;
}

.grid__edit--form > input:active,
.grid__edit--form > input:focus {
    outline: none;
}

.grid__edit--form > label {
    text-align: center;
}

/* button */
.btn__save {
    float: right;
    border: 0;
    background-color: rgba(6, 116, 210, 1);
    border-radius: 5px;
    box-shadow: 2px 2px 8px 2px rgba(0, 0, 0, .2);
    padding: 10px 15px;
    cursor: pointer;
    font-weight: 600;
    margin: 10px 0;
    color: white;
}

.btn__save:hover {
    background-color: rgb(10, 84, 150);
    transform: scale(1.1);
}

.col-header {
    flex: 1 1;
}

.col-entry {
    flex: 0 0;
    flex-basis: 20px;
}

.row-header {
    font-weight: 600;
}

.row-header,
.row-entry {
    height: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.row-entry:nth-child(even) {
    background-color: rgba(0, 0, 0, .05);
}

.col-header .row-header, .col-header .row-entry {
    align-items: flex-start;
}

.number-entry {
    text-align: center;
    padding: 5px;
    margin: 5px;
    width: 30px;
    border: 0;
    border-bottom: 2px solid rgba(0, 0, 0, .5);
    background-color: transparent;
}

.number-entry:active,
.number-entry:focus,
.number-entry:hover {
    outline: none;
    background-color: rgba(6, 116, 210, .05);
    border-bottom: 2px solid rgba(6, 116, 210, 1);
}

</style>
