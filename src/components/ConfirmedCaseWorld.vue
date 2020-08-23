<template>
  <div>
    <canvas id="chart" height="80"></canvas>
  </div>
</template>

<script>
// import ApexCharts from 'apexcharts';
import Chart from 'chart.js';
import dates from '../data/dates.json';
import datasets from '../data/b/datasets.json';

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
      const canvas = document.getElementById('chart');
      if (this.chart) {
        this.chart.destroy();
      }
      const rgb = this.hex.convertToRGB();

      this.chart = new Chart(canvas, {
        type: this.chartType,
        data: {
          labels: dates,
          datasets: [
            {
              label: 'Confirmed cases throughout the world',
              data: datasets,
              backgroundColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]}, 0.5)`,
              borderColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]},0.6)`
            }
          ]
        }
      })
    }
  },
  watch: {
    chartType() {
      this.rerender();
    },
    hex() {
      this.rerender();
    }
  }
}
</script>
