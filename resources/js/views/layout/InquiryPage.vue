<template>
  <div class="container">
    <div class="row py-3">
      <div class="col-md-12 pt-2 order-md-1 pb-2 han-layout">
        <h4 class="mb-3">Check Status</h4>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Transaction ID</th>
              <th scope="col">Amount</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="transaction in transactions" :key="transaction.TXID">
              <td style="width:10%">{{transaction.TRANS_DT}}</td>
              <td style="width:10%">{{transaction.TRANS_TM}}</td>
              <td style="width:40%">{{transaction.TXID}}</td>
              <td style="width:20%">{{transaction.AMT}}</td>
              <td style="width:20%">
                <router-link class="btn btn-success" :to="'/detail/'+transaction.TXID">Check</router-link>
                <!-- <button class="btn btn-primary" v-on:click="deleteData(transaction.TXID)">Delete</button> -->
              </td>
            </tr>
          </tbody>
        </table>
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
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/inquiry").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.transactions = response.data;
      });
    },
    deleteData(id) {
      // delete data
      axios.delete("http://localhost:8000/api/person/" + id).then(response => {
        this.loadData();
      });
    }
  }
};
</script>