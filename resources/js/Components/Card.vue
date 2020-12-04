<template>
    <div class="bg-blue-100 shadow overflow-hidden sm:rounded-lg">

        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                <slot name="header"></slot>
            </h3>
        </div>

        <div class="border-t border-gray-200">
            <dl>


                    <slot></slot>


            </dl>
        </div>

    </div>
</template>

<script>
export default {
    name: "Card"
}
</script>

