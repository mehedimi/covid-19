<template>
  <div>
    <canvas height="80" ref="chart"></canvas>
    <br>
    <canvas height="80" ref="chartW"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js';
import dates from '../data/dates.json';
import china from '../data/e/china.json';
import outsideWorld from '../data/e/outside-china.json'

export default {
  props: [
    'chartType',
    'hex'
  ],
  data() {
      return {
        chart1: null,
        chart2: null,
      }
  },
  mounted() {
    this.rerender();
  },
  methods: {
    rerender() {
      if(this.chart1) {
        this.chart1.destroy();
      }
      if(this.chart2) {
        this.chart2.destroy();
      }

      const rgb = this.hex.convertToRGB();

      this.chart1 = new Chart(this.$refs.chart, {
        type: this.chartType,
        data: {
          labels: dates,
          datasets: [
            {
              label: 'Covid 19 in China',
              data: china,
              backgroundColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]}, 0.5)`,
              borderColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]},0.6)`
            }
          ]
        }
      });

      this.chart2 = new Chart(this.$refs.chartW, {
        type: this.chartType,
        data: {
          labels: dates,
          datasets: [
            {
              label: 'Covid 19 on Outside China',
              data: outsideWorld,
              backgroundColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]}, 0.5)`,
              borderColor: `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]},0.6)`
            }
          ]
        }
      })
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
