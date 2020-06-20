<template>
  <div class="container">
    <div class="row py-3">
      <div class="col-md-6 pt-2 order-md-1 pb-2 han-layout">
        <h4 class="mb-3">Thank You and Have a Nicepay !</h4>

        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="han-group">
              <input v-model="response.resultCd" type="text" class="han-input" id="resultCd" />
              <span class="highlight"></span>
              <span class="han-bar"></span>
              <label class="han-label">Result Code</label>
            </div>
          </div>
          <div class="col-md-8 mb-3">
            <div class="han-group">
              <input v-model="response.resultMsg" type="text" class="han-input" id="resultMsg" />
              <span class="highlight"></span>
              <span class="han-bar"></span>
              <label class="han-label">Result Message</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="han-group">
              <input v-model="response.tXid" type="text" class="han-input" id="tXid" />
              <span class="highlight"></span>
              <span class="han-bar"></span>
              <label class="han-label">Transaction ID</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="han-group">
              <input v-model="response.bankCd" type="text" class="han-input" id="code" />
              <span class="highlight"></span>
              <span class="han-bar"></span>
              <label class="han-label">Bank</label>
            </div>
          </div>
          <div class="col-md-8 mb-3">
            <div class="han-group">
              <input v-model="response.vacctNo" type="text" class="han-input" id="vacctNo" />
              <span class="highlight"></span>
              <span class="han-bar"></span>
              <label class="han-label">VA Number & PayNo</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="han-group">
              <input v-model="response.vacctValidDt" type="text" class="han-input" id="validDt" />
              <span class="highlight"></span>
              <span class="han-bar"></span>
              <label class="han-label">Expired Date</label>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="han-group">
              <input v-model="response.vacctValidTm" type="text" class="han-input" id="ValidTm" />
              <span class="highlight"></span>
              <span class="han-bar"></span>
              <label class="han-label">Expired Time</label>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      response: this.$route.params.response
    };
  },
  created() {
    console.log(this.$route.params);
  },
  methods: {}
};
</script>