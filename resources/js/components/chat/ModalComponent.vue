<template>
    <transition name="modal" @close="showModal = false">
        <div class="modal-mask  modal-sm">
            <div class="modal-dialog">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                Введите сообщение для
                            </slot>
                        </div>
                        <div class="modal-body">
                            <slot name="body">
                                <textarea rows="10" cols="45" v-model="MessageText" name="MessageText"></textarea>
                                <button type="button" class="btn btn-primary" v-on:click="saveChange">Отправить
                                    сообщение
                                </button>
                                <button class="btn btn-secondary" v-on:click="$emit('close')">
                                    Закрыть
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            id: {
                type: Number,
                required: true
            }
        },
        name: 'modal',
        mounted() {
            //console.log(this.id);
        },
        data() {
            return {

                MessageText: ""
            }
        },
        methods: {
            close() {
                this.$emit('close')
            },
            findUserByid() {

            },
            saveChange() {
                //   console.log(this.MessageText)
                axios.post('api/conversation/send', {
                    contact_id: this.id,
                    text: this.MessageText
                }).then((response) => {
                    this.MessageText = "";
                    this.$emit('close');
                    this.close();
                });
                this.$emit('close');
                this.close();
            }
        },
    };
</script>

<style>
    textarea {
        width: 90%; /* Ширина поля в процентах */
        height: 200px; /* Высота поля в пикселах */
        resize: none; /* Запрещаем изменять размер */
    }

    .modal-mask {
        position: absolute;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 30px;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 100%;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    translation[name=modal] {
        background-color: yellow;
    }
</style>
