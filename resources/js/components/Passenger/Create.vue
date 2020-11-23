<template>
    <div class='container py-6'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-header'>Create Passenger</div>
                    <div class='card-body'>
                        <div class="alert alert-danger" v-if="errors.length">
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </div>

                        <form @submit.prevent="createService">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='name'>Name</label>
                                        <input type="text" class="form-control" id="name" v-model="passenger.name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='passport'>Passport</label>
                                        <input type="text" class="form-control" id="passport" v-model="passenger.passport">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='email'>Email</label>
                                        <input type="text" class="form-control" id="email" v-model="passenger.email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='mobile'>Mobile</label>
                                        <input type="text" class="form-control" id="mobile" v-model="passenger.mobile">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='mobile'>Service</label>
                                        <br>
                                        <div style="display: inline-block;margin-right: 5px" v-for="(service) in services" :key="service.id">
                                            <button v-on:click="GetServiceInfo($event)" class="btn btn-dark" :value="service.id">{{service.name}}</button>
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <router-link :to="{ name: 'passengers' }" class="btn btn-secondary">Back</router-link>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button class='btn btn-primary'>Submit</button>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                passenger:{},
                services:null,
                errors: [],
                name: null,
                service_data_list: [{
                }]
            }
        },
        created() {
            let uri = `/api/passenger/get-services`;
            this.axios.get(uri).then((response) => {
                this.services = response.data;
            });
        },
        methods: {
            GetServiceInfo: function(e) {
                alert(e.target.value);
              },
            createService(e){
                if (this.$data.passenger.name != null && this.$data.service_data_list.length > 1) {
                    let uri = '/api/passenger/store';
                    let payload = {
                        name:this.passenger.name,
                        service_data:this.service_data_list,
                    };

                    this.axios.post(uri, payload).then((response) => {

                        this.$swal.fire({
                            title: 'Success',
                            text: "Service created successfully",
                            icon: 'success',
                            timer: 1000
                        })
                        this.$router.push({name: 'home'});
                    });
                    return true;
                }

                this.errors = [];

                if (!this.passenger.name) {
                    this.errors.push('Please fill up the name filed !');
                }

                if (this.service_data_list.length == 1) {
                   this.errors.push('Please fill up the passenger data filed !');
                }

                e.preventDefault();
            }
        }
    }
</script>