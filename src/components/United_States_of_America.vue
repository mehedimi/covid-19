<template>
  <canvas ref="chart" height="80"></canvas>
</template>

<script>
  import Chart from 'chart.js';
  import dates from '../data/dates.json';
  import USA from "../data/h/United_States_of_America.json";

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
            labels: dates,
            datasets: [
              {
                label: 'United States of America',
                data: USA,
                backgroundColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]}, 0.5)`,
                borderColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]},0.6)`
              }
            ]
          }
        });
      }
    },
    watch: {
      hex() {
        this.rerender();
      },
      chartType() {
        this.rerender();
      }
    }
  }
</script>
