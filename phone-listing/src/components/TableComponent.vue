<template>
  <div class='container'>
    <div class='container-fluid'>
      <div class='row'>
        <table class='table table-striped'>
          <thead>
            <th>Country</th>
            <th>State</th>
            <th>Country Code</th>
            <th>Phone Nums</th>
          </thead>
          <tbody>
            <tr v-for='phone in this.$parent.phones'
                v-bind:key='phone.id'
                :value='phone.id'>
                  <td>{{ phone.country }}</td>
                  <td>{{ phone.status }}</td>
                  <td>{{ phone.code }}</td>
                  <td>{{ phone.clean_phone}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'TableCompenent',
  data: () => ({
    phones: []
  }),
  methods: {
    updateTable () {
      this.phones = this.$parent.phones
    }
  },
  created () {
    this.$emit('got_phones')
    this.updateTable()
  }
}
</script>
