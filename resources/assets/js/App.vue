<template>
  <main class="container" role="main">
    <div class=" d-flex align-items-center p-3 my-3 text-white-50 bg-primary rounded box-shadow">
      <div class="lh-100">
        <h6 class="mb-0 text-white lh-100">Colors app</h6>
        <small>Create your colors</small>
      </div>
    </div>
    <div class="card my-3 p-3 bg-white rounded box-shadow">
      <h6 class="border-bottom border-gray pb-2 mb-0">Colors list</h6>
      <color-component
          v-for="(color, index) in colors"
          v-bind="color"
          :key="color.id"
          :colors="colors"
          @delete="del"
      ></color-component>
    </div>
    <div>
      <add-color-component :colors="colors" :color="color"/>
    </div>
  </main>
</template>

<script>
import ColorComponent from './components/ColorComponent.vue';
import AddColorComponent from './components/AddColorComponent.vue';

export default {
  data() {
    return {
      colors: [],
      color: {
        id: '',
        name: '',
        hex: ''
      }
    }
  },
  methods: {
    async read() {
      window.axios.get('/api/color').then((response) => {
        response.data.forEach((color) => {
              this.colors.push({name: color.name, id: color.id, hex: color.hex});
            }
        );
      });
    },
    async del(id) {
      await window.axios.delete(`/api/color/${id}`);
      let index = this.colors.findIndex(color => color.id === id);
      this.colors.splice(index, 1);
    }
  },
  created() {
    this.read();
  },
  components: {
    ColorComponent,
    AddColorComponent
  }
}
</script>