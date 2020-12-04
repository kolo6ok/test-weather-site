<template>
    <card>
        <template #header> История </template>

        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <el-select v-model="countDays" placeholder="Количество дней" :disabled="loading" v-on:change="getTemp()">
                <el-option
                    v-for="item in options"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
            <div class="block"></div>
            <div class="flex-auto min-w-min bg-gray-50 custom-spinner"
                 v-loading="loading"
                 element-loading-background="rba(210, 214, 220, 0)"
                 customClass="pl-8"
            ></div>
        </div>

        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-7 sm:gap-4 sm:px-6">
            <div v-for="item in data"
                class="shadow-md h-24 w-24 flex-nowrap flex-col font-medium bg-white rounded-md flex items-center justify-around"
            >
                <div class="text-sm">{{ item.date_at }}</div>
                <div class="text-lg" :class="tempColor(item.temp)">{{ item.temp }}</div>
            </div>
        </div>

    </card>
</template>

<script>
import Card from "../Components/Card";

export default {

    components: {
        Card
    },

    name: "LastDays",

    data() {
        return {
            options: [
                { value: 30, label:'За 30 дней'},
                { value: 60, label:'За 60 дней'},
                { value: 90, label:'За 60 дней'}
            ],
            countDays: 30,
            loading: false,
            data: []
        }
    },
    mounted() {
        if (this.data.length == 0){
            this.getTemp()
        }
    },
    methods: {
        getTemp() {
            let $this = this
            this.loading = true
            window.axios.get('site/get-last-days?count=' + this.countDays).then((response)=>{
                let data = response.data
                if (data.errors.length == 0){
                  $this.data = data.data
                }
                $this.loading = false
            })
        },
        tempColor(temp) {
            let color = 'text-green-300'
            if (temp <= -40) {
                color = 'text-blue-700'
            } else if (temp > -40 && temp <= -20) {
                color = 'text-blue-500'
            } else if (temp > -20 && temp < 0) {
                color = 'text-blue-300'
            } else if (temp > 0  && temp < 20) {
                color = 'text-green-500'
            } else if (temp >= 20 && temp < 40) {
                color = 'text-yellow-300'
            } else if (temp >= 40) {
                color = 'text-red-500'
            }
            return color
        }
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
