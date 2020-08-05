<template>
  <div class="container">
    <form @submit.prevent="sendRequest">
      <!-- ROW ONE -->
      <div class="row pt-3">
        <!-- COLUMN SETTING -->
        <div class="col-md-4 order-md-2 han-rp">
          <button
            type="button"
            v-on:click="isHidden = !isHidden"
            @click="$event.target.classList.toggle('colActive')"
            class="collapsible accor-pad pt-2 pb-2 han-width han-rm btn-block han-layout colActive"
          >Settings</button>
          <div v-if="!isHidden" class="accor">
            <div class="accor-pad han-layout">
              <div class="row pt-3">
                <div class="col-md-6 mb-3">
                  <div class="han-group">
                    <select v-model="request.apiVersion">
                      <option value>Select API Version</option>
                      <option
                        v-for="(apiVer_key, apiVer) in request.listApiVersion"
                        :value="apiVer_key"
                        :key="apiVer"
                      >{{apiVer}}</option>
                    </select>
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">API Version</label>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="han-group">
                    <select v-model="request.env">
                      <option value>Select Environment</option>
                      <option
                        v-for="(environment_key,environment) in request.listEnv"
                        :value="environment_key"
                        :key="environment"
                      >{{environment}}</option>
                    </select>
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Environment</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="han-group">
                    <select v-model="request.payMethod">
                      <option value>Select Pay Method</option>
                      <option
                        v-for="(payMethods_key, payMethods) in request.listPayMethod"
                        :value="payMethods_key"
                        :key="payMethods"
                      >{{payMethods}}</option>
                    </select>
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Payment Methods</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="han-group">
                    <select
                      :disabled="request.payMethod == '01' || request.payMethod == ''"
                      v-model="request.code"
                    >
                      <option v-if="request.payMethod=='01' || request.payMethod == ''" value></option>
                      <option v-else value>Select Bank Or Mitra</option>
                      <option
                        v-for="(bankMitra_key, bankMitra) in request.listCode"
                        :value="bankMitra_key"
                        :key="bankMitra_key"
                      >{{bankMitra}}</option>
                    </select>
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Bank or Mitra</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ======================================================================================= -->

        <!-- COLUMN CHECKOUT -->
        <div class="col-md-8 order-md-1 han-rp">
          <button
            type="button"
            v-on:click="isHidden = !isHidden"
            @click="$event.target.classList.toggle('colActive')"
            class="collapsible remove-content accor-pad pt-2 pb-2 han-width han-rm btn-block han-layout colActive"
          >Checkout</button>
          <!-- <h4 class="mb-3">CHECKOUT</h4> -->
          <div v-if="!isHidden" class="accor">
            <div class="accor-pad han-layout">
              <div class="row pt-3">
                <div class="col-md-3 mb-3">
                  <div class="han-group">
                    <input v-model="request.iMid" type="text" class="han-input opacity" id="iMid" />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Merchant ID</label>
                  </div>
                </div>

                <div class="col-md-9 mb-3">
                  <div class="han-group">
                    <input
                      v-model="request.merchantKey"
                      type="text"
                      class="han-input opacity"
                      id="merchantKey"
                    />
                    <!-- <select v-model="request.apiVersion" ></select> -->
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Merchant Key</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="han-group">
                    <input
                      v-model="request.referenceNo"
                      type="text"
                      class="han-input opacity"
                      id="referenceNo"
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Reference Number</label>
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="han-group">
                    <input v-model="request.amt" type="number" class="han-input opacity" id="amt" />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Amount</label>
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="han-group">
                    <input
                      v-model="request.billingPhone"
                      type="text"
                      class="han-input opacity"
                      id="billingPhone"
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Phone Number</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="han-group">
                    <input
                      v-model="request.billingName"
                      type="text"
                      class="han-input opacity"
                      id="billingName"
                      value
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Billing Name</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ROW TWO -->
      <div class="row py-3">
        <!-- COLUMN ADDITIONAL -->
        <div class="col-md-12 order-md-1 han-rp han-layout">
          <!-- <h4 v-on:click="isHidden = !isHidden">Test</h4> -->
          <button
            type="button"
            v-on:click="isHidden3 = !isHidden3"
            @click="$event.target.classList.toggle('colActive')"
            class="collapsible accor-pad pt-2 pb-2 han-width han-rm btn-block han-layout"
          >Additional Info</button>

          <div v-if="!isHidden3" class="accor">
            <div class="accor-pad han-layout">

              <div class="row pt-3">
                <div class="col-md-2">
                  <div class="han-group">
                    <input
                      v-model="request.goodsNm"
                      type="text"
                      class="han-input opacity"
                      id="goodsNm"
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Goods Name</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="han-group">
                    <input
                      v-model="request.instmntType"
                      type="number"
                      class="han-input opacity"
                      id="instmntType"
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Installment Type</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="han-group">
                    <input
                      v-model="request.instmntMon"
                      type="number"
                      class="han-input opacity"
                      id="instmntMon"
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Installment Month</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="han-group">
                    <input
                      v-model="request.validDt"
                      type="text"
                      class="han-input opacity"
                      id="validDt"
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Valid Date</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="han-group">
                    <input v-model="request.validTm" type="text" class="han-input opacity" id="validTm" />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Valid Time</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="han-group">
                    <input
                      v-model="request.merFixAcctId"
                      type="text"
                      class="han-input opacity"
                      id="merFixAcctId"
                    />
                    <span class="han-highlight"></span>
                    <span class="han-bar"></span>
                    <label class="han-label">Fix Account ID</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="han-group">
                    <div class="han-group han-rm">
                      <label class="switch">
                        <input type="checkbox" v-model="selectAll" />
                        <span class="slider selectedCategory"></span>
                      </label>
                      <label class="han-font-size">Select Billing</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-2" v-for="bill in request.billingList" :key="bill.id">
                  <div class="han-group han-rm">
                    <label class="switch">
                      <input type="checkbox" :value="bill.id" v-model="request.billing" />
                      <span class="slider"></span>
                    </label>
                    <label class="han-font-size">{{ bill.name }}</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="han-group">
                    <div class="han-group han-rm">
                      <label class="switch">
                        <input type="checkbox" v-model="selectAllDelivery" />
                        <span class="slider selectedCategory"></span>
                      </label>
                      <label class="han-font-size">Select Delivery</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-3" v-for="deliv in request.deliveryList" :key="deliv.id">
                  <div class="han-group han-rm">
                    <label class="switch">
                      <input type="checkbox" :value="deliv.id" v-model="request.delivery" />
                      <span class="slider"></span>
                    </label>
                    <label class="han-font-size">{{ deliv.name }}</label>
                  </div>
                </div>
              </div>

              <!-- <div>billTest : {{ request.billing }}</div> -->
            </div>
          </div>
        </div>
      </div>

      <div class="row py-12 mb-3">
        <button class="btn btn-nicepay btn-lg btn-block" type="submit">Send Request</button>
      </div>
    </form>
  </div>
</template>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("colActive");
  });
}

export default {
  data() {
    return {
      // declare message with an empty value
      isHidden: false,
      isHidden2: false,
      isHidden3: true,

      request: {
        iMid: "IONPAYTEST",
        merchantKey: "",
        referenceNo: "",
        amt: "50",
        billingPhone: "081234500000",
        billingName: "John Doe",
        
        instmntType:"",
        instmntMon:"",
        goodsNm:"Test Payment Nicepay",
        validDt:"",
        validTm:"",
        merFixAcctId:"",

        apiVersion: "",
        listApiVersion: {
          "V1 Professional": "V1_Pro",
          "V1 Enterprise": "V1_Ent",
          "V2": "V2"
        },

        env: "",
        listEnv: {
          Local: "LOC",
          Dev: "DEV",
          Staging: "STG",
          Production: "PROD"
        },

        payMethod: "",
        listCode: "",
        code: "",

        listPayMethod: {
          "Credit Card": "01",
          "Virtual Account": "02",
          "Convenience Store": "03",
          "Ewallet": "05",
          "Payloan": "06"
        },

        vaList: {
          "Bank BCA": "CENA",
          "Bank Mandiri": "BMRI",
          "Bank BNI": "BNIN",
          "Bank BRI": "BRIN",
          "Bank Cimb Niaga": "BNIA",
          "Bank Permata": "BBBA"
        },

        cvsList: {
          Indomaret: "INDO",
          Alfamart: "ALFA",
          Payfazz: "PAYF"
        },

        ewalletList: {
          OVO: "OVEO",
          "Link Aja": "LINK",
          DANA: "DANA"
        },

        payloanList: {
          Kredivo: "KDVI",
          Akulaku: "AKLP"
        },
        

        billing: [],
        billingList: [
          { id: "billingEmail", name: "Billing Email", checked: false },
          { id: "billingAddress", name: "Billing Address", checked: false },
          { id: "billingCity", name: "Billing City", checked: false },
          { id: "billingState", name: "Billing State", checked: false },
          { id: "billingPost", name: "Billing Post", checked: false },
          { id: "billingCountry", name: "Billing Country", checked: false }
        ],

        delivery: [],
        deliveryList: [
          { id: "deliveryNm", name: "Delivery Name", checked: false },
          { id: "deliveryPhone", name: "Delivery Phone", checked: false },
          { id: "deliveryAddr", name: "Delivery Address", checked: false },
          { id: "deliveryCity", name: "Delivery City", checked: false },
          { id: "deliveryState", name: "Delivery State", checked: false },
          { id: "deliveryPostCd", name: "Delivery PostCd", checked: false },
          { id: "deliveryCountry", name: "Delivery Country", checked: false }
        ]

      }
    };
  },

  created() {
    this.generateReferenceNo();
    this.request.apiVersion = "V2";
    this.request.env = "PROD";
    this.request.payMethod = "02";
    this.selectAll={checked: true};
    this.selectAllDelivery={checked: true};
    linkActiveClass: "is-active";
  },

  computed: {
    selectAll: {
      get: function() {
        return this.request.billingList
          ? this.request.billing.length == this.request.billingList.length
          : false;
      },
      set: function(value, $event) {
        var billing = [];

        if (value) {
          this.request.billingList.forEach(function(user) {
            billing.push(user.id);
          });
        }

        this.request.billing = billing;
      }
    },
    selectAllDelivery: {
      get: function() {
        return this.request.deliveryList
          ? this.request.delivery.length == this.request.deliveryList.length
          : false;
      },
      set: function(value, $event) {
        var delivery = [];

        if (value) {
          this.request.deliveryList.forEach(function(user) {
            delivery.push(user.id);
          });
        }

        this.request.delivery = delivery;
      }
    }
  },

  methods: {
    checkAll: function(idx, $event) {
      var member = this.teams[idx].members;
      for (var memberIdx in member) {
        member[memberIdx].checked = $event.target.checked;
      }
    },

    generateReferenceNo() {
      this.request.referenceNo =
        "NCPY-" + Math.floor(100000000 + Math.random() * 9000000000);
    },
    
    generateValidDtTm() {
      const today = new Date();
      const expired = new Date(today.getTime() + (7 * 24 * 60 * 60 * 1000));
      
      const month = ('0' + (expired.getMonth()+1)).slice(-2) ;
      const day =  ('0' + expired.getDate()).slice(-2);
      
      const hours = ('0' + expired.getHours()).slice(-2) ;
      const minutes =  ('0' + expired.getMinutes()).slice(-2);
      const seconds =  ('0' + expired.getSeconds()).slice(-2);

      const validDt = expired.getFullYear()+''+month+''+day;
      const validTm =hours+''+minutes+''+seconds;

      this.request.validDt =validDt;
      this.request.validTm =validTm;
    },

    sendRequest() {
      let uri = "http://localhost:8000/sendRequestCheckout";
      axios
        .post(uri, this.request)
        .then(response => {
          console.log(response);
          //  this.$router.push({name: 'result', params: {resultCd:response.data[0].resultCd, resultMsg:response.data[0].resultMsg}});
          if (response) {
            this.$router.push({
              name: "result",
              params: { response: response.data[0] }
            });
          }
        })
        .catch(error => {
          // this.validation = error.response.data.data; //response validation
          this.$router.push({ name: "otherError" });
        });
    },

    clearAdditional(){
      this.request.instmntType ="";
      this.request.instmntMon ="";
      this.request.validDt= "";
      this.request.validTm= "";
    }
  },

  watch: {
    "request.payMethod": function() {
      // Clear previously selected values
      this.request.listCode = [];
      this.request.code = "";
      // Populate list of countries in the second dropdown
      if (this.request.payMethod == "01") {
          this.request.code;
          this.clearAdditional();
          this.request.instmntType ="1";
          this.request.instmntMon ="1";
      } else if (this.request.payMethod == "02") {
          this.request.listCode = this.request.vaList;
          this.clearAdditional();
          this.generateValidDtTm();
      } else if (this.request.payMethod == "03") {
          this.request.listCode = this.request.cvsList;
          this.clearAdditional();
      } else if (this.request.payMethod == "05") {
          this.request.listCode = this.request.ewalletList;
          this.clearAdditional();
      } else if (this.request.payMethod == "06") {
          this.request.listCode = this.request.payloanList;
          this.clearAdditional();  
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