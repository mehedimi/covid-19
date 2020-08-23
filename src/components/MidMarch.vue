<template>
  <canvas ref="chart" height="80"></canvas>
</template>

<script>
import Chart from 'chart.js';
import countries from './../data/i/countries.json';
import mid from '../data/i/mid.json';

export default {
  props: [
    'chartType',
    'hex'
  ],
  data() {
      return {
        chart: null
      }
  },
  mounted() {
    this.rerender();
  },
  methods: {
    rerender() {
      if(this.chart) {
        this.chart.destroy();
      }
      const rgb = this.hex.convertToRGB();
      this.chart = new Chart(this.$refs.chart, {
        type: this.chartType,
        data: {
          labels: countries,
          datasets: [
            {
              label: 'Covid 19 in Mid March',
              data: mid,
              backgroundColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]}, 0.5)`,
              borderColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]},0.6)`
            }
          ]
        }
      });
    }
  },
  watch: {
    rgb() {
      this.rerender();
    },
    chartType() {
      this.rerender();
    }
  }
}
</script>
