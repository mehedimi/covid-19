<template>
  <div id="app">
    <ul class="menu">
      <li v-for="(chart, index) in charts" :key="index">
        <button :class="{active: index === activeComponent}" @click="activeComponent = index">{{ chart }}</button>
      </li>
      <br>
      <Sketch :value="colors" @input="updateColor"></Sketch>
      <select class="input" v-model="chartType">
        <option v-for="(c, ind) in chartTypes" :key="ind" :value="ind">{{c}}</option>
      </select>
    </ul>

    <component :hex="colors.hex.substr(1, 6)" :chart-type="chartType" :is="activeComponent"></component>
  </div>
</template>

<script>
import ConfirmedCaseWorld from "./components/ConfirmedCaseWorld";
import Compared from "./components/Compared";
import United_States_of_America from "./components/United_States_of_America";
import MidMarch from "./components/MidMarch";
import Sketch from 'vue-color/src/components/Sketch'
import debounce from 'lodash.debounce';

String.prototype.convertToRGB = function(){
  if(this.length != 6){
    throw "Only six-digit hex colors are allowed.";
  }

  const aRgbHex = this.match(/.{1,2}/g);
  return [
    parseInt(aRgbHex[0], 16),
    parseInt(aRgbHex[1], 16),
    parseInt(aRgbHex[2], 16)
  ];
}

export default {
  data() {
      return {
        activeComponent: 'ConfirmedCaseWorld',
        charts: {
          ConfirmedCaseWorld: 'Confirmed Cases',
          Compared: 'Compare word with china',
          United_States_of_America: 'Hardest Hit',
          MidMarch: 'Mid March',
        },
        chartTypes: {
          bar: 'Bar',
          line: 'Line'
        },
        chartType: 'line',
        colors: {
          hex: '#e74c3c',
          // hsl: { h: 150, s: 0.5, l: 0.2, a: 1 },
          // hsv: { h: 150, s: 0.66, v: 0.30, a: 1 },
          // rgba: { r: 231, g: 76, b: 60, a: 1 },
          // a: 1
        }
      }
  },
  components: {
    // eslint-disable-next-line vue/no-unused-components
    ConfirmedCaseWorld,
    // eslint-disable-next-line vue/no-unused-components
    Compared,
    // eslint-disable-next-line vue/no-unused-components
    United_States_of_America,
    MidMarch,
    Sketch
  },
  mounted() {
    this.$set(this.colors, 'hex', this.getRandomColor());
  },
  methods: {
    updateColor: debounce(function (colors) {
      this.colors = colors;
    }, 500),
    getRandomColor() {
      const letters = '0123456789ABCDEF';
      let color = '#';
      for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }
  }
}
</script>

<style lang="scss">
  #app {
    font-family: "Fira Code",serif;
  }
  .menu {
    text-align: center;
    list-style: none;
    li {
      display: inline-block;
      margin-right: 10px;
      button {
        background-color: #1abc9c;
        border: 1px solid #1abc9c;
        color: #fff;
        padding: 10px;
        cursor: pointer;
        &:hover{
          background-color: #ffffff;
          color: #1abc9c;
        }
        &.active {
          background-color: #ffffff;
          color: #1abc9c;
        }
      }
    }
  }
  .input {
    margin: 10px;
  }
</style>
