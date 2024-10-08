<template lang="">
    <div>
        <v-data-table :items="data" :headers="headers">
            <template v-slot:item.status="{ item }">
                <v-chip :color="service_general.getColorChipStatus(item.status)"> {{ $filters.uppercase(item.status) }} </v-chip>
            </template>
            <template v-slot:item.action="{ item }">
                <v-btn @click="updateToDoItem(item, true)" variant="plain" color="green" icon><v-icon icon="mdi-thumb-up" /></v-btn>
                <v-btn @click="updateToDoItem(item, false)" variant="plain" color="orange" icon><v-icon icon="mdi-thumb-down" /></v-btn>
                <v-btn @click="trashToDoItem(item, false)" variant="plain" color="red" icon><v-icon icon="mdi-trash-can" /></v-btn>
            </template>
        </v-data-table>
    </div>
</template>
<script>
import general from "../services/general.js";

export default {
    props: ["data"],
    data() {
        return {
            // items: [],
            headers: [
                { title: "Description", key: "description" },
                { title: "Status", key: "status" },
                { title: "Action", key: "action" },
            ],
            user: {},
            service_general: general,
        };
    },
    async mounted() {
    },
    methods: {
        async updateToDoItem(item, bool) {
            console.log(item);
            let response = await axios.put("/api/todoUpdate/" + item.id, {
                status: bool ? "completed" : "pending",
            });
            this.$emit("reloadData");
        },

        async trashToDoItem(item) {
            let response = await axios.delete("/api/todoDelete/" + item.id);
            this.$emit("reloadData");
        },
    },
};
</script>
<style lang=""></style>
