<template>
  <div>
  <div v-if="profile" class="profile-header__vote js-profile-header-buttons">
    {{profile.name}}
    <div v-if="profile.relation_id">{{profile.relation}}</div>
    <img v-if="profile.photo_url" :src="profile.photo_url" height="150px">
    <hr>
    <h2>Я хочу</h2>

    <span class="label label-info"  v-for="item in profile.targets">{{ item.name }}
    </span>

    <h2>Интересы</h2>

    <span class="label label-info"  v-for="item in profile.interest">{{ item.name }}
    </span>


  </div>
  </div>
</template>

<script>
export default {
name: "Anket",
    data() {
        return {
            profile: null,
        }
    },
    mounted() {
        console.log("anket")
        console.log(this.$route.params.unique_id);
        this.getAnket();
    },
    methods: {
        getAnket() {
            this.axios
                .get(`/api/anket/${this.$route.params.unique_id}`)
                .then((res) => {
                    this.profile = res.data.data;
                    console.log(this.profile)
                    console.log(this.profile.targets)
                });
        }
    }
}
</script>

<style scoped>

</style>
