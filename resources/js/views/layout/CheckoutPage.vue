<template>
  <div class="container">
    <form @submit.prevent="sendRequest">
      <div class="row py-3">
        <div class="col-md-4 pt-2 order-md-2 pb-2 han-layout">
          <h4 class="mb-3">Settings</h4>
          <div class="row">
            <div class="col-md-8 mb-3">
              <div class="group">
                <select v-model="request.selectedapiVersion" >
                    <option value="">Select API Version</option>
                    <option v-for="apiVer in request.apiVersion" :key="apiVer">{{apiVer}}</option>
                </select>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">API Version</label>
              </div>
            </div>  
            <div class="col-md-4 mb-3">
              <div class="group">
                <select v-model="request.selectedEnv" >
                    <option value="">Select Env</option>
                    <option v-for="environment in request.env" :key="environment">{{environment}}</option>
                </select>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Env</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <div class="group">            
                  <select v-model="request.payMethod" >
                    <option value="">Select Pay Method</option>
                    <option v-for="(payMethods_key, payMethods) in request.listPayMethod" :value="payMethods_key" :key="payMethods">{{payMethods}}</option>
                  </select>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label class="han-label">Payment Methods</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <div class="group">
                <select :disabled="request.payMethod == '01' || request.payMethod == ''" v-model="request.code" >
                  <option v-if="request.payMethod=='01' || request.payMethod == ''" value=""></option>
                  <option v-else value="">Select Bank Or Mitra</option>
                  <option v-for="(bankMitra_key, bankMitra) in request.listCode" :value="bankMitra_key" :key="bankMitra_key">{{bankMitra}}</option>
                </select>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Bank or Mitra</label>
              </div>
            </div>
          </div>
        </div>
        <!-- ======================================================================================= -->

        <div class="col-md-8 pt-2 order-md-1 pb-2 han-layout-opacity">
          <h4 class="mb-3">Checkout</h4>

          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="group">
                <input v-model="request.iMid" type="text" class="han-input opacity" id="iMid" />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Merchant ID</label>
              </div>
            </div>

            <div class="col-md-9 mb-3">
              <div class="group">
                <input v-model="request.merchantKey" type="text" class="han-input opacity" id="merchantKey" />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Merchant Key</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="group">
                <input v-model="request.referenceNo" type="text" class="han-input opacity" id="referenceNo" />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Reference Number</label>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="group">
                <input v-model="request.amt" type="number" class="han-input opacity" id="amt" />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Amount</label>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="group">
                <input v-model="request.billingPhone" type="text" class="han-input opacity" id="billingPhone"/>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Phone Number</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="group">
                <input v-model="request.billingName" type="text" class="han-input opacity" id="billingName" value />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="han-label">Billing Name</label>
              </div>
            </div>
          </div>

          <!-- <hr class="mb-4" /> -->
          <!-- <button class="btn btn-nicepay btn-lg btn-block" type="submit">
            <i class="fa fa-credit-card"></i> Send Request
          </button> -->

        </div>
      </div>
      <div class="row py-12">
        <button class="btn btn-nicepay btn-lg btn-block" type="submit">
            <i class="fa fa-credit-card"></i> Send Request
        </button>
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
            // payMethod: "02",
           
            apiVersion: ["V1 Professional", "V1 Enterprise", "", "V2"],
            env: ["Dev", "Staging", "Production"],
            selectedapiVersion : "",
            selectedEnv : "",
            
            listCode: "",
            payMethod: "",
            code: "",

            listPayMethod : {
              "Credit Card" : "01",
              "Virtual Account" : "02",
              "Convenience Store" : "03" ,
              "Ewallet" : "05",
              "Payloan" : "06"
            },
            
            vaList : {
              "Bank BCA" : "CENA",
              "Bank Mandiri" : "BMRI",
              "Bank BNI" : "BNIN",
              "Bank BRI" : "BRIN",
              "Bank Cimb Niaga" : "BNIA",
              "Bank Permata" : "BBBA"
            },

            cvsList : {
              "Indomaret" : "INDO",
              "Alfamart" : "ALFA",
              "Payfazz" : "PAYF",
            },

            ewalletList : {
              "OVO" : "OVEO",
              "Link Aja" : "LINK",
              "DANA" : "DANA",
            },
            
            payloanList : {
               "Kredivo" : "KDVI",
               "Akulaku" : "AKLP"
            }
             
      }
    };
  },

  created() {
    this.generateReferenceNo();
    // this.changePayMethod();
  },

  methods: {
    generateReferenceNo() {
        this.request.referenceNo = 'NCPY-'+ Math.floor(100000000 + Math.random() * 9000000000);
    },

    sendRequest() {
      let uri = 'http://localhost:8000/sendRequestCheckout';
      axios.post(uri, this.request)
       .then((response) => {
         console.log(response);
          //  this.$router.push({name: 'result', params: {resultCd:response.data[0].resultCd, resultMsg:response.data[0].resultMsg}});
          if(response){
          this.$router.push({name: 'result', params: {response:response.data[0]}});
          }
        }).catch(error => {
            // this.validation = error.response.data.data; //response validation
          this.$router.push({name: 'otherError'});
         });
    },
  },

  watch: {
    'request.payMethod': function() {
        // Clear previously selected values
        this.request.listCode = [];
        this.request.code = "";
        // Populate list of countries in the second dropdown
        if (this.request.payMethod == "01") {
            this.request.code 
        }else if (this.request.payMethod == "02") {
            this.request.listCode = this.request.vaList;
        }else if(this.request.payMethod == "03"){
            this.request.listCode = this.request.cvsList;
        }else if(this.request.payMethod == "05"){
            this.request.listCode = this.request.ewalletList;
        }else if(this.request.payMethod == "06"){
            this.request.listCode = this.request.payloanList;
        }
    }
  }
  //   'request.payMethod': function() {
  //       // Clear previously selected values
  //       this.request.listCode = [];
  //       this.request.code = "";
  //       // Populate list of countries in the second dropdown
  //       if (this.request.payMethod.length > 0) {
  //           this.request.listCode = this.request.listPayMethod[this.request.payMethod]
  //       }
  //   }
  // }

};
</script>

      <!-- <h5 class="mb-3 ">Payment Methods</h5>
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
                @change="changePayMethod "
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
          </div> -->