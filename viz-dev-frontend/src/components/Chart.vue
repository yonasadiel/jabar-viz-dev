<template>
    <div>
        <div id="placeholder"></div>
    </div>
</template>

<script>

import { apiConfig } from '../api';

const config = {
  locale: {
    filePath: 'https://s3-eu-west-1.amazonaws.com/static.gapminderdev.org/assets/translation/',
  },
  data: {
    reader: 'csv-time_in_columns',
    path: `${apiConfig.baseURL}/entries`,
  },
};

function loadScript(link) {
  return new Promise((resolve, reject) => {
    try {
      const script = document.createElement('script');
      script.setAttribute('src', link);
      script.onload = () => {
        resolve(true);
      };
      document.head.appendChild(script);
    } catch (e) {
      reject(e);
    }
  });
}

export default {
  data() {
    return {

    };
  },

  async mounted() {
    const scripts = [
      '//d3js.org/d3.v4.min.js',
      '//s3-eu-west-1.amazonaws.com/static.gapminderdev.org/vizabi/develop/vizabi.min.js',
      '//s3-eu-west-1.amazonaws.com/static.gapminderdev.org/bubblechart.js',
      '//s3-eu-west-1.amazonaws.com/static.gapminderdev.org/preview/master/assets/vendor/js/vizabi-ws-reader/vizabi-ws-reader.js',
      '//s3-eu-west-1.amazonaws.com/static.gapminderdev.org/systema-globalis/master/ConfigBubbleChart.js',
    ];
    for (let i = 0; i < scripts.length; i += 1) {
      /* eslint-disable no-await-in-loop */
      await loadScript(scripts[i]);
    }
    /* eslint-disable no-undef */
    Vizabi('BubbleChart', document.getElementById('placeholder'), config);
  },
};
</script>

<style scoped>
#placeholder {
  height: 600px;
  margin: 10px 15px;
}
</style>
