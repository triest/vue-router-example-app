<template>
  <div>

      <div class="row rounded-lg overflow-hidden ">
        <!-- Users box-->
        <div class="col-4 px-0">
          <div class="bg-white">
            <ContactsList :contacts="contacts" :target_user="target_user" @selected="startConversationWith"/>
          </div>
        </div>
        <!-- Chat Box-->
        <Conversation :contact="selectedContact" :unreaded="unreaded" :target_user="target_user" :messages="messages" @new="saveNewMessage"/>
      </div>


  </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    import {mapActions} from "vuex";

    export default {
        props: {
            target_user:{
                type: Object,
                required: false,
                default:null,
            }
        },
        computed : {
        /*    user: {
                get: function () {
                    let user=this.$store.getters.get_user
                    return user
                },
                set:function (newValue){
                    this.$store.dispatch('SAVE_USER',newValue)
                }
            },
*/
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                unreaded: 0,
                user:null
            };
        },
        mounted() {
          this.getUser();
          this.getContacts();
        },
        methods: {
            getUser(){
                axios.get('/api/user')
                    .then((response) => {
                        this.user = response.data;
                    });
            },
            getContacts(){
              axios.get('/api/contact/')
                  .then((response) => {
                    this.contacts = response.data;
                  });
            },
            startConversationWith(contact, image) {
                axios.get(`/api/contact/conversation/${contact.uuid}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })

            },
            saveNewMessage(message) {
               // this.messages.push(message);
                this.startConversationWith(message,null)

             //   this.getContacts();
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.to === this.selectedContact.uuid) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false);
            },
              updateUnreadCount(contact, reset) {
                  /*this.contacts = this.contacts.map((single) => {
                      if (single.id !== contact.id) {
                          return single;
                      }

                      if (reset)
                          single.unread = 0;
                      else
                          single.unread += 1;

                      return single;
                  }),
                      this.unreaded = single.unread;*/
              }

        },
        components: {Conversation, ContactsList}
    }
</script>

<!--
<style lang="scss" scoped>
    .chat-app {
        display: flex;
    }
</style>
-->
