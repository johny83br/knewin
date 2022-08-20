<template>
    <form id="login-form" :action="href" method="POST">
        <!-- <form v-on:submit.prevent="login"> -->
        <input type="hidden" name="_token" :value="csrf" />

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email"> Email Address</label>
                    <input
                        type="email"
                        v-model="email"
                        class="form-control"
                        name="email"
                        placeholder="email@dominio.com"
                    />
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password"> Password</label>
                    <input
                        type="password"
                        v-model="password"
                        class="form-control"
                        name="password"
                        placeholder="Password"
                    />
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-5 offset-md-7">
                <div class="d-grid gap-1">
                    <button class="btn btn-lg btn-primary">Sign in</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            email: "",
            password: "",
            message: "",
            href: "/login",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
};
</script>
