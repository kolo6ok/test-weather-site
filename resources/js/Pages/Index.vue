<template>
    <app-layout>

        <daytemp></daytemp>

        <div class="py-5"></div>

        <last-days></last-days>

    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout'
import Daytemp from "../Components/DayTemp";
import LastDays from "../Components/LastDays";

export default {
    components: {
        AppLayout,
        Daytemp,
        LastDays
    },
    name: "Index",

}
</script>
