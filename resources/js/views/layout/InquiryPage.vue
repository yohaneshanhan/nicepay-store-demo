<template>
  <div class="container">
    <div class="row pt-3">
      <div class="col-md-12 pt-2 order-md-1 pb-2 han-layout">
        <h4 class="mb-3" style="font-size:18px">Check Status</h4>

        <div class="row">
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="han-group">
                  <input type="text" class="han-input opacity" id="iMid" />
                  <span class="han-highlight"></span>
                  <span class="han-bar"></span>
                  <label class="han-label">Merchant ID</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="han-group">
                  <input type="text" class="han-input opacity" id="iMid" />
                  <span class="han-highlight"></span>
                  <span class="han-bar"></span>
                  <label class="han-label">Merchant Key</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="han-group">
                  <input type="text" class="han-input opacity" id="iMid" />
                  <span class="han-highlight"></span>
                  <span class="han-bar"></span>
                  <label class="han-label">Transaction ID</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
              <button class="btn btn-nicepay btn-lg btn-block" type="submit">Send Request</button>
            </div>
            </div>
          </div>

          <div class="col-md-8 mb-3">
            <table class="table han-rm">
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
                    <router-link class="btn btn-nicepay btn-table-size btn-lg btn-block" :to="'/detail/'+transaction.TXID">Check</router-link>
                    <!-- <button class="btn btn-primary" v-on:click="deleteData(transaction.TXID)">Delete</button> -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
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
    linkActiveClass: "is-active";
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/getData").then(response => {
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