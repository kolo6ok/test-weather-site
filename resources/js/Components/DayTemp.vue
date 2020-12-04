<template>
    <card>
        <template #header> Температура за день </template>

        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <div class="block">
                <el-date-picker
                    v-model="date"
                    type="date"
                    format="yyyy-MM-dd"
                    v-on:change="onChangeDatePicker"
                    :disabled="loading"
                    placeholder="Выберите день">
                </el-date-picker>
            </div>

            <div class="flex items-center">
                <h3 class="text-base leading-5 font-medium text-gray-900">
                    {{ showDate }}
                </h3>
            </div>
            <div class="flex-auto min-w-min bg-gray-50 custom-spinner"
                 v-loading="loading"
                 element-loading-background="rba(210, 214, 220, 0)"
                 customClass="pl-8"
            ></div>
        </div>
    </card>
</template>

<script>
import Card from "../Components/Card";

export default {

    components: {
        Card
    },

    name: "DayTemp",

    data() {
        return {
            date:'',
            showDate: '',
            loading: false
        }
    },
    methods: {
        onChangeDatePicker() {
            let $this = this
            let date = this.date.toDateString()
            this.loading = true
            this.showDate = ''
            window.axios.get('site/get-temp?date=' + date).then((response)=>{
                let data = response.data
                if (data.errors.length == 0){
                    $this.showDate = 'Температура ' + data.data.temp + ' градусов'
                } else {
                    $this.showDate = ''
                }
                $this.loading = false
            })
        },

    }
}
</script>

<style>
    .custom-spinner .el-loading-spinner {
        padding-left: 80%;
    }

    .custom-spinner .el-loading-mask {
        background-color: transparent;
    }
</style>


