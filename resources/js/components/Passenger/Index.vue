<template>
    <div class='container py-4'>
        <div class='row justify-content-center'>
            <div class='col-md-8'>
            <div class='card'>
                <div class='card-header'>All Services</div>
                <div class='card-body'>
                    <router-link :to="{ name: 'create-passenger' }" class="btn btn-primary">Create New Services</router-link>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="50" class="text-center">SN</th>
                                    <th>Name</th>
                                    <th width="50" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(passenger, index) in passengers.data" :key="passenger.id">
                                    <td width="50" class="text-center">{{ index + 1 }}</td>
                                    <td>{{ passenger.name }}</td>
                                    <td width="200" class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-danger" @click = "deletePost(passenger.id)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :data="passengers" @pagination-change-page="getResults"></pagination>
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
          passengers: {}
        }
    },
    created() {
            this.getResults();
    },
    methods: {
        getResults(page){

            let uri = 'api/passengers?page=' + page;
            this.axios.get(uri).then(response => {
                        return response.data;
                    }).then(data => {
                        this.passengers = data;
                    });
        },
        deletePost(id)
        {
            this.$swal.fire({
                title: 'are you sure want to delete?',
                text: "You will not be able to recover this imaginary file.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it!",   
                cancelButtonText: "No, cancel plx!",
                }).then((result) => {
                if (result.value) {
                    this.$swal.fire({
                        title: 'Success!',
                        text: 'Passenger deleted successfully',
                        icon: 'success',
                        timer: 1000
                    });
                    let uri = `api/passenger/delete/${id}`;
                    this.axios.delete(uri).then(response => {
                        this.getResults();
                    });
                }
            })
        }
    }
  }
</script>