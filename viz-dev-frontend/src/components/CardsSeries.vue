<template>
    <div class="flex-row flex-wrap container__card">
      <div v-for="content in series">
        <div class="cards">
          <div class="container">
            <h4><b>{{ content.name }}</b></h4>
            <p> {{ content.description }} </p>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: 'CardsSeries',
  data() {
    return {
      series: [],
    };
  },
  methods: {
    retrieveSeries() {
      api.get('/series').then((response) => {
        this.series = response.data;
      });
    },
  }
};
</script>
  
<style scoped>
.logo__follow--btnPlay {
  width: 45px;
  height: 43px;
}

.logo__dropdown--x {
  width: 180px;
  height: 26px;
}

.logo__timeline {
  width: 180px;
  height: 29px;
}

.flex-row {
  display: flex;
  flex-direction: row;
}

.flex-wrap {
  flex-wrap: wrap;
}

.container__card {
  text-align: center;
  align-items: center;
  justify-content: center;
}

.cards {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 200px;
  height: 165px;
  margin: 5px 10px;
  padding: 5px;
  cursor: pointer;
}

.cards:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
  transform: scale(1.1);
}

.container {
  padding: 2px 16px;
}
</style>
