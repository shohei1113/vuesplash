<template>
    <div class="container--small">
        <ul class="tab">
            <li
                class="tab__item"
                :class="{'tab__item--active': tab === 1}"
                @click="tab = 1"
            >Login</li>
            <li
                class="tab__item"
                :class="{'tab__item--active': tab === 2}"
                @click="tab = 2"
            >Register</li>
        </ul>
        <div class="panel" v-show="tab === 1">
            <form class="form" @submit.prevent="login">
                <div v-if="loginErrors" class="errors">
                    <ul v-if="loginErrors.email">
                        <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
                    </ul>
                    <ul v-if="loginErrors.password">
                        <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
                    </ul>
                </div>
                <label for="login-email">Email</label>
                <input type="text" class="form__item" id="login-email" v-model="loginForm.email">
                <label for="login-password">Password</label>
                <input type="password" class="form__item" id="login-password" v-model="loginForm.password">
                <div class="form__button">
                    <button type="submit" class="button button--inverse">login</button>
                </div>
            </form>
        </div>
        <div class="panel" v-show="tab === 2">
            <form class="form" @submit.prevent="register">
                <div v-if="registerErrors" class="errors">
                    <ul v-if="registerErrors.name">
                        <li v-for="msg in registerErrors.name" :key="msg">{{ msg }}</li>
                    </ul>
                    <ul v-if="registerErrors.email">
                        <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
                    </ul>
                    <ul v-if="registerErrors.password">
                        <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
                    </ul>
                </div>
                <label for="username">Name</label>
                <input type="text" class="form__item" id="username" v-model="registerForm.name">
                <label for="email">Email</label>
                <input type="text" class="form__item" id="email" v-model="registerForm.email">
                <label for="password">Password</label>
                <input type="password" class="form__item" id="password" v-model="registerForm.password">
                <label for="password-confirmation">Password (confirm)</label>
                <input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation">
                <div class="form__button">
                    <button type="submit" class="button button--inverse">register</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex'

export default {
    data () {
        return {
            tab: 1,
            loginForm: {
                email: '',
                password: ''
            },
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    // computed: {
    //     apiStatus () {
    //         return this.$store.state.auth.apiStatus
    //     },
    //     loginErrors () {
    //         return this.$store.state.auth.loginErrorMessages
    //     }
    //     registerErrors () {
    //         return this.$store.state.auth.registerErrorMessages
    //     }
    // },
    computed: mapState ({
        apiStatus: state => state.auth.apiStatus,
        loginErrors: state => state.auth.loginErrorMessages,
        registerErrors: state => state.auth.registerErrorMessages
    }),
    methods: {
        async login () {
            await this.$store.dispatch('auth/login', this.loginForm)

            if (this.apiStatus) {
                this.$router.push('/')
            }
        },
        async register () {
            await this.$store.dispatch('auth/register', this.registerForm)

            if (this.apiStatus) {
                this.$router.push('/')
            }
        },
        clearError () {
            this.$store.commit('auth/setLoginErrorMessages', null)
            this.$store.commit('auth/setRegisterErrorMessages', null)
        },
        writeTempalte: function () {
            this.msg = "初めまして（氏名）です。本日はお忙しい中お会いしていただき誠にありがとうございます。是非またお会いしましょう！"
        }
    },
    created () {
        this.clearError()
    }
}
</script>
