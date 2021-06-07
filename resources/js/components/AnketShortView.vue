<template>
  <div>
    <a :href="'anket/'+user.unique_id">
      <div v-if="user.online===true" class="cell-online">
        <div class="cell-online-overflow">
          <span class="online"></span>
        </div>
      </div>
      <img width="250" height="250" :src="user.photo_url">
      <div class="cell">
        <div class="cell-overflow">
          {{ user.name }}
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
    name: "AnketShortView",
    props: {
        user: {
            type: Object,
            required: false
        }
    },
}
</script>
