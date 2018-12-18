<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-card shadow="never">
                    <div slot="header">
                        <span>Add Payment</span>
                    </div>
                    <el-form ref="form" @submit.native.prevent="onSubmit" :model="form" label-width="120px">
                        <el-form-item prop="details" :rules="$root.validate.required" label="Detail">
                            <el-input v-model="form.details"></el-input>
                        </el-form-item>
                        <el-form-item prop="invoice_id" :rules="$root.validate.required" label="Invoice">
                                <el-select
                                        style="width: 100%;"
                                        size="small"
                                        v-model="form.invoice_id"
                                        :disabled="disabled"
                                        filterable
                                        remote
                                        required
                                        placeholder="Enter Invoice Keyboard"
                                        :remote-method="search_invoice"
                                        :loading="loading">
                                    <el-option
                                            v-for="(item, index) in invoices"
                                            :key="index"
                                            :label="item.label"
                                            :value="item.value">
                                    </el-option>
                                </el-select>
                        </el-form-item>
                        <el-form-item>
                            <el-button :disabled="disabled" type="primary" @click="onSubmit('form')">{{$route.params.id
                                ? 'Edit' : 'Create'}}
                            </el-button>
                            <el-button @click="onCancel">Cancel</el-button>
                        </el-form-item>
                    </el-form>
                </el-card>

            </el-col>
        </el-row>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                validate: {
                    details: [
                        {required: true}
                    ]
                },
                form: {
                    details: '',
                    invoice_id: ''
                },
                invoices:[],
                loading: false,
                disabled: false
            }
        },
        beforeRouteEnter (to, from, next) {
            if (to.params.id) {
                axios.get(`/api/payments/${to.params.id}`).then(function (response) {
                    next(vm => vm.setData(response.data))
                })
            } else {
                next()
            }
        },
        beforeRouteUpdate (to, from, next) {
            var vm = this
            if (to.params.id) {
                axios.get(`/api/payments/${to.params.id}`).then(function (response) {
                    vm.setData(response.data)
                    next()
                })
            } else {
                next()
            }
        },
        methods: {
            setData(response){
                this.form = response
            },
            onCancel(){
                this.$router.push({name: 'view-payment'})
            },
            search_invoice(query){
                var vm = this
                if (query !== '') {

                    vm.onSearchInvoice(query, vm)
                } else {
                    vm.loading = false
                    vm.invoices = []
                }
            },
            onSearchInvoice: _.debounce(function (query, vm) {
                vm.loading = true
                axios.get('/api/invoices/search?search=' + query).then(function (q) {
                    vm.loading = false
                    vm.invoices = q.data.map(item => {
                        return {value: item.id, label: item.billboardhired.subject.details};
                    })
                }).catch(function () {
                    vm.loading = false
                })
            }, 350),
            onSubmit() {
                var vm = this
                this.$refs.form.validate((valid) => {
                    if (valid) {
                        vm.disabled = true
                        let id = vm.$route.params.id;
                        axios[id ? 'put' : 'post'](`/api/payments${id ? `/${id}` : ''}`, vm.form).then(function () {
                            vm.disabled = false
                            vm.$message({
                                type: 'success',
                                message: 'Billboard has been created'
                            })
                        }).catch(function (error) {
                            vm.disabled = false
                            if (error.response.statusText) {
                                vm.$message({
                                    type: 'error',
                                    message: error.response.statusText
                                })
                            }
                        })
                    }
                })

            }
        }
    }
</script>