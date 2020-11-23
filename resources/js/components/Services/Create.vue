<template>
    <div class='container py-6'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-header'>Create Serivce</div>
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
                                        <input type="text" class="form-control" id="name" v-model="service.name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class='form-group'>
                                        <label htmlFor='service_temp_data'>Service Data</label>
                                        <input type="text" class="form-control" id="service_temp_data" v-model="service.service_temp_data">
                                    </div>
                                </div>

                                <div class="col-md-3 text-right">
                                   <p style="margin-top: 30px;"></p>
                                    <button class="btn btn-success" @click.prevent="AddData">Add Data</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="80%">Data</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="service_temp_data_tbody">
                                            <tr v-for="(service_data, k) in service_data_list" :key="k">
                                                <td>
                                                    <span>{{service_data.service_data_title}}</span>
                                                    <input class="form-control" type="hidden" v-model="service_data.service_data_title"/>
                                                </td>

                                                <td>
                                                    <button class="btn btn-danger" @click="deleteData(k, service_data)">Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link :to="{ name: 'home' }" class="btn btn-secondary">Back</router-link>
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
                service:{},
                errors: [],
                name: null,
                service_data_list: [{
                }]
            }
        },
        methods: {

            AddData(){
                this.errors = [];
                if (!this.service.service_temp_data) {
                    this.errors.push('Please Fill The Service Data');
                }else{
                   var service_temp_data = this.service.service_temp_data
                    this.service_data_list.push({
                        service_data_title: service_temp_data,
                    });

                    this.service.service_temp_data = ''; 
                }
                
            },

            deleteData(index, service_data) {
                var idx = this.service_data_list.indexOf(service_data);
                if (idx > -1) {
                    this.service_data_list.splice(idx, 1);
                }
            },

            createService(e){
                if (this.$data.service.name != null && this.$data.service_data_list.length > 1) {
                    let uri = '/api/service/store';
                    let payload = {
                        name:this.service.name,
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

                if (!this.service.name) {
                    this.errors.push('Please fill up the name filed !');
                }

                if (this.service_data_list.length == 1) {
                   this.errors.push('Please fill up the service data filed !');
                }

                e.preventDefault();
            }
        }
    }
</script>

<style type="text/css">
    #service_temp_data_tbody tr:first-child {
      display: none;
    }
</style>