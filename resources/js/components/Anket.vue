<template>
  <div>
    <div class="container">
      <div id="flex-container">
        <div class="raw-item" id="raw"> <img v-if="profile.photo_url" :src="profile.photo_url" height="150px"></div>
        <div class="flex-item" id="flex">{{profile.name}},{{profile.age}}</div>
      </div>
      <hr>
      <h2>Я хочу</h2>
      <span class="label label-info"  v-for="item in profile.targets">{{ item.name }},</span>
      <hr>
      <h2>Интересы</h2>
      <span class="label label-info"  v-for="item in profile.interest">{{ item.name }},
    </span>
      <hr>
      <h2>Личная информация:</h2>
      <div v-if="profile.relation">
        Отношения: {{profile.relation}}
      </div>
      <div v-if="profile.children">
        Дети: {{profile.children}}
      </div>
      <div v-if="profile.smoking">
        Курение: {{profile.smoking}}
      </div>
      <div v-if="profile.alcohole">
        Алкоголь: {{profile.alcohole}}
      </div>
      <div v-if="profile.height">
        Рост: {{profile.height}}
      </div>
      <div v-if="profile.body_type">
        Телосложение: {{profile.body_type}}
      </div>
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
                    document.title = this.profile.name;

                });
        }
    }
}
</script>

<style scoped>
#flex-container {
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: row;
    flex-direction: row;
}

#flex-container > .flex-item {
    -webkit-flex: auto;
    flex: auto;

}

#flex-container > .raw-item {
    width: 10rem;
}

</style>
