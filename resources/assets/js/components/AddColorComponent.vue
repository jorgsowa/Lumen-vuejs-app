<template>
  <div>
    <div class="text-center">
    <b-button v-b-toggle.collapse-1 variant="primary" clss="btn btn-primary">Add color</b-button>
  </div>
    <b-collapse id="collapse-1" class="mt-2">
      <b-card>
        <form action="#" @submit.prevent="create()">
          <div class="form-group">
            <label for="name">Name</label>
            <input v-model="name" placeholder='Name' type="text" name="name" class="form-control">
            <p v-if="errors.name" class="small text-danger">{{ errors.name | mergeErrors }}</p>
          </div>
          <div class="form-group">
            <label for="hex">Hex</label>
            <input v-model="hex" placeholder='Hex' type="color" name="hex" class="form-control">
            <p v-if="errors.hex" class="small text-danger">{{ errors.hex | mergeErrors }}</p>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add color</button>
          </div>
        </form>
      </b-card>
    </b-collapse>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      errors: [],
      hex: ''
    }
  },
  props: ['colors'],
  methods: {
    async create() {
      window.axios.post('/api/color/create', {name: this.name, hex: this.hex}
      ).then((response) => {
        this.colors.push(response.data);
        this.errors = [];
        this.name = '';
        this.hex = '';
      }).catch((error) => {
        this.errors = error.response.data;
      });
    }
  },
  filters: {
    mergeErrors: function(value) {
      return value.join();
    }
  }
}
</script>
<style>

</style>