<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5>Phone Numbers</h5>

                    <div class="card-body">
                        <div class='container'>
                            <dropdown-selects></dropdown-selects>
                        </div>

                        <div class='container'>
                            <result-table></result-table>
                        </div>

                        <div class='container'>
                            <paginate></paginate>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
