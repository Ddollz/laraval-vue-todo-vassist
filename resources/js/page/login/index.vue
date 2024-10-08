<template lang="">
    <v-card width="400">
        <template v-slot:title>
            <span class="font-weight-black">
                LOGIN
                <v-btn to="/register" variant="plain">Register</v-btn>
            </span>
        </template>
        <v-card-text class="pt-4">
            <v-form @submit.prevent="submit">
                <v-text-field v-model="username" :rules="rules" label="Username"></v-text-field>
                <v-text-field v-model="password" type="password" :rules="rules" label="Password"></v-text-field>
                <v-btn class="mt-2" type="submit" block>Submit</v-btn>
            </v-form>
        </v-card-text>
        <v-snackbar v-model="snackbar" color="error">
            {{ text }}
            <template v-slot:actions>
                <v-btn variant="text" @click="snackbar = false"> Close </v-btn>
            </template>
        </v-snackbar>
    </v-card>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            username: "",
            password: "",
            snackbar: false,
            rules: [(v) => !!v || "Field is required"],
        };
    },
    methods: {
        async submit() {
            let response = await axios.post("/api/login", { username: this.username, password: this.password });
            if (response.data.status == "success") {
                const token = response.data.authorisation.token;
                console.log(token)
                localStorage.setItem("token", token);
                localStorage.setItem("user", JSON.stringify(response.data.user));
                const user = JSON.parse(localStorage.getItem('user'));
                console.log('user',user);
                this.$router.push({ name: "todo" });
            } else {
                this.text = response.data.message;
                this.snackbar = true;
            }
        },
    },
};
</script>
<style lang=""></style>
