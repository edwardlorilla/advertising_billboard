<template>
    <div>
        <grid-view :columns="columns"
                   :data="data"
                   create-name="Add Billboard Hired"
                   on-delete="/api/billboardhireds"
                   on-edit-name="edit-billboardhired"
                   on-create-name="create-billboardhired"
                   @delete="data.splice($event, 1)"
        ></grid-view>
    </div>
</template>
<style>
</style>
<script>
    import GridView from './../Table/Grid.vue'
    export default{
        data(){
            return {
                columns: [
                    {
                        label: 'Billboard',
                        prop: 'billboard.details'
                    },
                    {
                        label: 'Hired',
                        prop: 'subject.details'
                    },
                    {
                        label: 'Date Hired From',
                        prop: 'date_hired_from'
                    },
                    {
                        label: 'Date Hired To',
                        prop: 'date_hired_to'
                    }
                ],
                data: []
            }
        },
        components: {
            GridView,
        },
        beforeRouteEnter (to, from, next) {
            axios.get(`/api/billboardhireds`, {params: to.query}).then(function (response) {
                next(vm => vm.setData(response.data))
            })
        },
        beforeRouteUpdate (to, from, next) {
            var vm = this
            axios.get(`/api/billboardhireds`, {params: to.query}).then(function (response) {
                vm.setData(response.data)
                next()
            })
        },
        methods: {
            setData(response){
                this.data = response
            },
        }
    }
</script>