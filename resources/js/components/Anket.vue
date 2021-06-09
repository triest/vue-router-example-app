<template>

</template>

<script>
export default {
name: "Anket",

    mounted() {
        console.log("anket")
        console.log(this.$route.params.unique_id);
        this.getAnket();
    },
    methods: {
        getAnket(){
            this.axios
                .get(`/api/anket/${this.$route.params.unique_id}`)
                .then((res) => {
                    this.product = res.data;
                });
        }
    }
}
</script>

<style scoped>

</style>
