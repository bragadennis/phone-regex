<template>
  <div class='container-fluid'>

    <div class='container'>
      <div class='row'>
        <SelectComponent v-on:update_table="changedSelect"></SelectComponent>
      </div>
    </div>

    <!-- Table area -->
    <div class='container'>
      <div class='row'>
        <TableComponent v-on:got_phones="updatePhones"></TableComponent>
      </div>
    </div>

    <div class='container-fluid'>
      <div class='row'>
        <div class='col-6'></div>
        <div class='col-6'>
          <div class='row'>
            <div class='col-6'>
              <a href='#' v-on:click="pagination((current_page - 1))">
                < Prev
              </a>
            </div>
            <div class='col-6'>
              <a href='#' v-on:click="pagination((current_page + 1))">
                Next >
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import SelectComponent from '@/components/SelectComponent.vue'
import TableComponent from '@/components/TableComponent.vue'
export default {
  name: 'Index',
  components: { SelectComponent, TableComponent },
  data: () => ({
    phones: [],
    base_url: 'http://localhost:8000/api/customer/list',
    selected_status: this.status,
    selected_country: this.country,
    current_page: 1
  }),
  props: {
    status: '',
    country: ''
  },
  methods: {
    assembleUrl (params) {
      let url = this.base_url

      if (params !== undefined) {
        url += '?'

        if ('country' in params) {
          url += 'country=' + params['country'] + '&'
        }

        if ('status' in params) {
          url += 'status=' + params['status']
        }

        if ('page' in params) {
          url += '&page=' + params['page']
        }
      }

      return url
    },
    updatePhones (url) {
      this.$http.get(url).then((response) => {
        this.phones = response.data.customers.data

        this.current_page = response.data.customers.current_page
      })
    },
    changedSelect (data) {
      let arr = {}

      if (this.selected_country !== '') {
        arr.country = this.selected_country
      }

      if (this.selected_status !== '') {
        arr.status = this.selected_status
      }

      if (data.type === 'country') {
        arr.country = data['value']
        this.selected_country = data['value']
      }

      if (data.type === 'status') {
        arr.status = data['value']
        this.selected_status = data['value']
      }

      console.log(data)
      this.updatePhones(this.assembleUrl(arr))
    },
    pagination (page) {
      console.log()
      let arr = {}

      if (this.selected_country !== '' && this.selected_country !== undefined) {
        arr.country = this.selected_country
      }

      if (this.selected_status !== '' && this.selected_status !== undefined) {
        arr.status = this.selected_status
      }

      if (page > 0) {
        arr.page = page
      }

      this.updatePhones(this.assembleUrl(arr))
    }
  },
  created () {
    this.updatePhones(this.assembleUrl())
  }
}
</script>
