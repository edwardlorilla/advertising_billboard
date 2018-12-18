<template>
<div>
<el-row>
<el-col :span="24">
<el-card shadow="never">
<div slot="header">
<span>Add Billboard Hired</span>
</div>
<el-form ref="form" @submit.native.prevent="onSubmit" :model="form" label-width="120px">
<el-form-item prop="billboard_id" :rules="$root.validate.required" label="Billboard">
<el-select
style="width: 100%;"
size="small"
v-model="form.billboard_id"
:disabled="disabled"
filterable
remote
required
placeholder="Enter Billboard Keyboard"
:remote-method="search_billboard"
:loading="loading">
<el-option
v-for="(item, index) in billboards"
:key="index"
:label="item.label"
:value="item.value">
</el-option>
</el-select>
</el-form-item>
<el-form-item prop="billboardpartytype" :rules="$root.validate.required" label="Hiring Parties">
<el-select
style="width: 100%;"
size="small"
v-model="form.billboardpartytype"
placeholder="Enter Hiring Parties Keyboard">
<el-option label="Client" value="clients"></el-option>
<el-option label="Agency" value="agencies"></el-option>
</el-select>
</el-form-item>
<el-form-item prop="type" :rules="$root.validate.required" :label="type">
<el-select
style="width: 100%;"
size="small"
v-model="form.type"
:disabled="disabled"
filterable
remote
required
:placeholder="`Enter ${type} Keyboard`"
:remote-method="search_type"
:loading="loading">
<el-option
v-for="(item, index) in types"
:key="index"
:label="item.label"
:value="item.value">
</el-option>
</el-select>
</el-form-item>
<el-form-item prop="date_hired_from" label="Date Hired From">
<el-date-picker
v-model="form.date_hired_from"
type="datetime">
</el-date-picker>
</el-form-item>
<el-form-item prop="date_hired_to" label="Date Hired To">
<el-date-picker
v-model="form.date_hired_to"
type="datetime">
</el-date-picker>
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
billboard_id: '',
billboardpartytype: 'clients',
date_hired_from: '',
date_hired_to: '',
},
billboards:[],
types:[],
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
computed:{
type(){
return this.form.billboardpartytype == 'clients' ? 'Client' : 'Agency'
}
},
methods: {
setData(response){
this.form = response
},
onCancel(){
this.$router.push({name: 'view-billboardhired'})
},
search_billboard(query){
var vm = this
if (query !== '') {
vm.onSearchBillboard(query, vm)
} else {
vm.loading = false
vm.billboardhireds = []
}
},
onSearchBillboard: _.debounce(function (query, vm) {
vm.loading = true
axios.get('/api/billboards/search?search=' + query).then(function (q) {
vm.loading = false
vm.billboards = q.data.map(item => {
return {value: item.id, label: item.details};
})
}).catch(function () {
vm.loading = false
})
}, 350),
search_type(query){
var vm = this
if (query !== '') {

vm.onSearchType(query, vm)
} else {
vm.loading = false
vm.billboardhireds = []
}
},
onSearchType: _.debounce(function (query, vm) {
vm.loading = true
axios.get(`/api/${vm.form.billboardpartytype}/search?search=${query}`).then(function (q) {
vm.loading = false
vm.types = q.data.map(item => {
return {value: item.id, label: item.details};
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
axios[id ? 'put' : 'post'](`/api/billboardhireds${id ? `/${id}` : ''}`, vm.form).then(function () {
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