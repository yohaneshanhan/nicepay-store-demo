<template>
  <div class="container">
    <div class="row py-2">
      <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Other Error</h4>
        <label for="iMid">Error Page</label>
      </div>
    </div>
  </div>
</template>

<!-- script js -->
<script>
export default {
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      transactions: []
    };
  },
  created() {
    // this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/inquiry").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.transactions = response.data;
      });
    }
  }
};
</script>