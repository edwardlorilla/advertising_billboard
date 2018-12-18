<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-card shadow="never">
                    <div slot="header">
                        <span>Add Invoice</span>
                    </div>
                    <el-form ref="form" @submit.native.prevent="onSubmit" :model="form" label-width="120px">
                        <el-form-item prop="details" :rules="$root.validate.required" label="Detail">
                            <el-input v-model="form.details"></el-input>
                        </el-form-item>
                        <el-form-item prop="billboardhired_id" :rules="$root.validate.required" label="Billboard Hired">
                                <el-select
                                        style="width: 100%;"
                                        size="small"
                                        v-model="form.billboardhired_id"
                                        :disabled="disabled"
                                        filterable
                                        remote
                                        required
                                        placeholder="Enter Billboard Hired Keyboard"
                                        :remote-method="search_billboard_hired"
                                        :loading="loading">
                                    <el-option
                                            v-for="(item, index) in billboardhireds"
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
                    billboardhired_id: ''
                },
                billboardhireds:[],
                loading: false,
                disabled: false
            }
        },
        beforeRouteEnter (to, from, next) {
            if (to.params.id) {
                axios.get(`/api/billboards/${to.params.id}`).then(function (response) {
                    next(vm => vm.setData(response.data))
                })
            } else {
                next()
            }
        },
        beforeRouteUpdate (to, from, next) {
            var vm = this
            if (to.params.id) {
                axios.get(`/api/billboards/${to.params.id}`).then(function (response) {
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
                this.$router.push({name: 'view-billboard'})
            },
            search_billboard_hired(query){
                var vm = this
                if (query !== '') {

                    vm.onSearchBillboardHired(query, vm)
                } else {
                    vm.loading = false
                    vm.billboardhireds = []
                }
            },
            onSearchBillboardHired: _.debounce(function (query, vm) {
                vm.loading = true
                axios.get('/api/billboardhireds/search?search=' + query).then(function (q) {
                    vm.loading = false
                    vm.billboardhireds = q.data.map(item => {
                        return {value: item.id, label: item.subject.details};
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
                        axios[id ? 'put' : 'post'](`/api/invoices${id ? `/${id}` : ''}`, vm.form).then(function () {
                            vm.disabled = false
                            vm.$message({
                                type: 'success',
                                message: 'Invoices has been created'
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