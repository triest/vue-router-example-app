<template>
  <div>
    <!--  <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link> -->
    <router-link :to="{name:'anket',params:{unique_id: user.unique_id}}">
      <div v-if="user.online===true" class="cell-online">
        <div class="cell-online-overflow">
          <span class="online"></span>
        </div>
      </div>
      <img width="200" height="200" :src="user.photo_url">
      <div class="cell">
        <div class="cell-overflow">
          {{ user.name }}
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
    name: "AnketShortView",
    props: {
        user: {
            type: Object,
            required: true
        }
    },
}
</script>
