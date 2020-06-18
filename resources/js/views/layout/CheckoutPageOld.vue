<template>
  <div class="container">
    <form @submit.prevent="sendRequest">
      <div class="row py-2">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="mb-3">Payment Methods</h4>
          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input
                v-model="request.payMethod"
                type="radio"
                class="custom-control-input"
                id="cc"
                value="01"
              />
              <label class="custom-control-label" for="cc">Direct CC</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                v-model="request.payMethod"
                @change="changePayMethod"
                type="radio"
                class="custom-control-input"
                id="va"
                value="02"
              />
              <label class="custom-control-label" for="va">Virtual Account</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                v-model="request.payMethod"
                @change="changePayMethod"
                type="radio"
                class="custom-control-input"
                id="cvs"
                value="03"
              />
              <label class="custom-control-label" for="cvs">Convenience Store</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                v-model="request.payMethod"
                @change="changePayMethod"
                type="radio"
                class="custom-control-input"
                id="ewallet"
                value="05"
              />
              <label class="custom-control-label" for="ewallet">Ewallet</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                v-model="request.payMethod"
                @change="changePayMethod"
                type="radio"
                class="custom-control-input"
                id="payloan"
                value="06"
              />
              <label class="custom-control-label" for="payloan">Payloan</label>
            </div>
          </div>

          <h4 class="mb-3">Bank or Mitra</h4>
          <div class="d-block my-3">
            <!-- <div class="form-control"> -->
              <select v-html="optionsList" v-model="request.optionsCode" class="form-control" ></select>
            <!-- </div> -->
          </div>
        </div>

        <!-- ======================================================================================= -->

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Checkout</h4>

          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="iMid">Merchant ID</label>
              <input v-model="request.iMid" type="text" class="form-control" id="iMid" />
            </div>

            <div class="col-md-9 mb-3">
              <label for="merchantKey">Merchant Key</label>
              <input v-model="request.merchantKey" type="text" class="form-control" id="merchantKey" />
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="referenceNo">Reference Number</label>
              <input v-model="request.referenceNo" type="text" class="form-control" id="referenceNo" />
            </div>
            <div class="col-md-3 mb-3">
            <div class="group">
              <input type="text" name="referenceNo" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Test</label>
            </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="amount">Amount</label>
              <input v-model="request.amt" type="number" class="form-control" id="amt" />
            </div>

            <div class="col-md-3 mb-3">
              <label for="billingPhone">Phone Number</label>
              <input v-model="request.billingPhone" type="text" class="form-control" id="billingPhone"/>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="billingName">Billing Name</label>
              <input v-model="request.billingName" type="text" class="form-control" id="billingName" value />
            </div>
          </div>

          <hr class="mb-4" />
          <button class="btn btn-nicepay btn-lg btn-block" type="submit">
            <i class="fa fa-credit-card"></i> Send Request
          </button>

        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {

  data() {
    return {
      // declare message with an empty value
      request:{
            iMid: "IONPAYTEST",
            merchantKey: '',
            referenceNo: '',
            amt: "50",
            billingPhone: "081234500000",
            billingName: "John Doe",
            payMethod: "02",
            optionsCode: "",
           
      },
       optionsList: ""
    };
  },

  created() {
    this.generateReferenceNo();
  },

  methods: {
    generateReferenceNo() {
        this.request.referenceNo = 'NCPY-'+ Math.floor(100000000 + Math.random() * 9000000000);
    },

    sendRequest() {
      // fetch data dari api menggunakan axios
      // axios.post("http://localhost:8000/sendRequest").then(response => {
        // mengirim data hasil fetch ke varibale array persons
      //   this.transactions = response.data;
      // });

      let uri = 'http://localhost:8000/sendRequestCheckout';
      axios.post(uri, this.request)
       .then((response) => {
         console.log(response);
          //  this.$router.push({name: 'result', params: {resultCd:response.data[0].resultCd, resultMsg:response.data[0].resultMsg}});
          this.$router.push({name: 'result', params: {response:response.data[0]}});
        }).catch(error => {
            // this.validation = error.response.data.data; //response validation
          this.$router.push({name: 'otherError'});
         });
    },

    changePayMethod() {
      switch (this.request.payMethod) {
        case "02":
          this.optionsList =
            '<option disabled value="">Select Bank</option>' +
            '<option value="CENA">Bank BCA</option>' +
            '<option value="BMRI">Bank Mandiri</option>' +
            '<option value="BNIN">Bank BNI</option>' +
            '<option value="BRIN">Bank BRI</option>' +
            '<option value="BNIA">Bank CIMB Niaga</option>' +
            '<option value="BBBA">Bank Permata</option>' +
            '<option value="BBBB">Bank Permata Syariah</option>' +
            '<option value="BDIN">Bank Danamon</option>' +
            '<option value="HNBN">Bank Hana</option>';
          break;
        case "03":
          this.optionsList =
            '<option disabled value="">Select Convenience Store</option>' +
            '<option value="ALMA">Alfamart</option>' +
            '<option value="INDO">Indomaret</option>' +
            '<option value="PAYF">Payfazz</option>';
          break;
        case "05":
          this.optionsList =
            '<option disabled value="">Select Mitra E-Wallet</option>' +
            '<option value="OVOE">OVO</option>' +
            '<option value="LINK">Link Aja</option>' +
            '<option value="DANA">DANA</option>';
          break;
        case "06":
          this.optionsList =
            '<option disabled value="">Select Mitra Online Credit</option>' +
            '<option value="KDVI">Kredivo</option>' +
            '<option value="AKLK">Akulaku</option>';
          break;
      }
    }
  }

};
</script>