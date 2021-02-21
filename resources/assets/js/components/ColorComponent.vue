<template>
  <div>
    <hr v-if="this.colors[0].id !== this.id" class="w-100 m-0"/>
    <div class="media text-muted p-3">
      <div alt="32x32" class="mr-2 rounded mt-1" style="width:32px;height:32px;"
           v-bind:style=" { backgroundColor: '#'+ hex }"></div>
      <div class="d-flex justify-content-between align-items-center w-100">
        <p class="media-body mb-0 small lh-125">
          <strong class="d-block text-gray-dark">Name: {{ name }}</strong>
          <strong>Hex: </strong> #{{ hex | lowercase }}
        </p>
        <button class="btn bg-light" @click="del">Delete</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    console.log(this);
  },
  methods: {
    del() {
      this.$emit('delete', this.id);
    }
  },
  props: ['colors', 'id', 'name', 'hex'],
  filters: {
    lowercase: function (value) {
      return value.toLowerCase();
    }
  }
}
</script>

<style>

</style>