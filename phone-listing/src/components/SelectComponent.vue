<template>
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-6'>
        <select class='form-control'
                @input="$emit('update_table', {type: 'country', value: $event.target.value})"
                name="countries"
                id="countries">
          <option value="null">--</option>
          <option v-for="country in countries"
                  v-bind="country"
                  :key="country.value"
                  :value="country.value"
                  :country="country.value">
                  {{ country.country }}
          </option>
        </select>
      </div>

      <div class='col-6'>
        <select class='form-control'
                @input="$emit('update_table', {type: 'status', value: $event.target.value})"
                name="statuses"
                id="statuses">
          <option value="null">--</option>
          <option v-for="status in [{key : 'true', value : 'OK'},
                                    {key : 'false', value : 'NOK'}]"
                  v-bind="status"
                  :key="status.key"
                  :value="status.key"
                  :status="status.key">
                    {{ status.value }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'SelectCompenent',
  data: () => ({
    countries: []
  }),
  methods: {
    listCountries () {
      this.$http.get('http://localhost:8000/api/prefix/list').then((response) => {
        this.countries = response.data.countries
      })
    }
  },
  created () {
    this.listCountries()
  }
}
</script>
