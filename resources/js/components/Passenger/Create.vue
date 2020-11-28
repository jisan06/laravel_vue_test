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

                        <form>
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
                                        <label htmlFor='services'>Service</label>
                                        <br>
                                        <div style="display: inline-block;margin-right: 5px" v-for="(service) in services" :key="service.id">
                                            <button v-on:click="GetServiceInfo($event)" class="btn btn-dark" :value="service.id">{{service.name}}</button>
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="border: 1px solid rgb(146 144 144);padding: 20px;margin-bottom: 40px;;" v-if="services_data_list">

                                        <h5>Service Information for {{service_name}}</h5>
                                                <hr>
                                        <div class="row" v-for="(service_data, index) in services_data_list" :key="service_data.id">
                                            <div class="col-md-12">
                                                <div class='form-group'>
                                                    <label htmlFor='service_data'>{{service_data.service_data_title}}</label>
                                                    <input type="hidden" v-model="service_data.service_data_title_id">
                                                    <input type="text" class="form-control" id="service_data" v-model="service_data.service_data_title_value" :key="index">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <router-link :to="{ name: 'passengers' }" class="btn btn-secondary">Back</router-link>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button v-on:click="createPassenger" class='btn btn-primary'>Submit</button>
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
                service_id:null,
                service_name:null,
                services_data_list: [],
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
                e.preventDefault();
                this.services_data_list = [];
                this.service_id = e.target.value;
                this.service_name = e.target.innerHTML;
                let payload = {
                    service_id: this.service_id,
                };

                let url = `/api/passenger/get-services-info`;
                    this.axios.post(url,payload).then((response) => {
                        for(var row of response.data) {
                            this.services_data_list.push(
                                { 
                                    service_data_title: row.title,
                                    service_data_title_id: row.id,
                                    service_data_title_value: ''
                                }
                             );
                        }
                        
                    });
              },
            createPassenger(e){
                e.preventDefault();
                let uri = '/api/passenger/store';
                let payload = {
                    passenger:this.passenger,
                    service_id:this.service_id,
                    services_data_list: this.services_data_list,
                };

                

                this.axios.post(uri, payload).then((response) => {

                    this.$swal.fire({
                        title: 'Success',
                        text: "Service created successfully",
                        icon: 'success',
                        timer: 1000
                    })
                    this.$router.push({name: 'passengers'});
                });
                return true;

            this.errors = [];
            }
        }
    }
</script>