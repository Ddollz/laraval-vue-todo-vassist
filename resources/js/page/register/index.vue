<template lang="">
    <v-card width="400">
        <template v-slot:title>
            <span class="font-weight-black">
                REGISTER
                <v-btn to="/login" variant="plain">Login</v-btn>
            </span>
        </template>
        <v-card-text class="pt-4">
            <v-form @submit.prevent="submit">
                <v-text-field v-model="username" :rules="rules" label="Username"></v-text-field>
                <v-text-field v-model="email" :rules="emailRules" label="Email"></v-text-field>
                <v-text-field v-model="firstname" :rules="rules" label="First Name"></v-text-field>
                <v-text-field v-model="lastname" :rules="rules" label="Last Name"></v-text-field>
                <v-text-field v-model="password" :rules="rules" type="password" label="Password"></v-text-field>
                <v-btn class="mt-2" type="submit" block>Submit</v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            username: "",
            firstname: "",
            lastname: "",
            email: "",
            password: "",

            emailRules: [
                (value) => {
                    if (value) return true;

                    return "E-mail is requred.";
                },
                (value) => {
                    if (/.+@.+\..+/.test(value)) return true;

                    return "E-mail must be valid.";
                },
            ],
            rules: [(v) => !!v || "Field is required"],
        };
    },
    methods: {
        async submit() {
            await axios
                .post("/api/register", {
                    username: this.username,
                    password: this.password,
                    email: this.email,
                    firstname: this.firstname,
                    lastname: this.lastname,
                })
                .then((response) => {
                    console.log(response);
                    if (response.data.message == "sucess") {
                        this.$router.push({ name: "login" });
                    }
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>
<style lang=""></style>
