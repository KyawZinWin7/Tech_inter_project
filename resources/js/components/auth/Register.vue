<template>
    <div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card border-0 mb-0 auth-card">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <b>Register with credentials</b>
                            </div>
                            <form role="form">
                                <div class="form-group mb-3">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i class="ni ni-email-83"></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="User Name"
                                            type="text"
                                            v-model="name"
                                        />
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i class="ni ni-email-83"></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="Email"
                                            type="email"
                                            v-model="email"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i
                                                    class="
                                                        ni ni-lock-circle-open
                                                    "
                                                ></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="Password"
                                            type="password"
                                            ref="password"
                                            v-model="password"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div
                                        class="
                                            input-group
                                            input-group-merge
                                            input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i
                                                    class="
                                                        ni ni-lock-circle-open
                                                    "
                                                ></i
                                            ></span>
                                        </div>
                                        <input
                                            class="form-control pl-2"
                                            placeholder="Confirm Password"
                                            type="password"
                                            ref="password"
                                            v-model="confirm_password"
                                        />
                                    </div>
                                </div>

                                <div
                                    class="
                                        custom-control
                                        custom-control-alternative
                                        custom-checkbox
                                    "
                                >
                                    <input
                                        class="custom-control-input"
                                        id=" customCheckLogin"
                                        type="checkbox"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for=" customCheckLogin"
                                    >
                                        <b class="text-muted">Remember me</b>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary my-4"
                                        @click="register"
                                    >
                                        Sign in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Toast } from "vant";
export default {
    data() {
        return {
            isSignin: false,
            email: "",
            password: "",
            confirm_password: "",
            name: "",
        };
    },
    methods: {
        async register() {
            try {
                this.$auth.register({
                    data: {
                        email: this.email,
                        name: this.name,
                        password: this.password,
                        confirm_password: this.confirm_password,
                    },
                    redirect: "/category/index",
                    staySignedIn: true,
                    autoLogin: true,
                });
                Toast.success("Success");
            } catch (error) {
                Toast.fail("Fail");
            }
        },
    },
    mounted() {
        if (this.$auth.check()) {
            this.$router.push("/category/index");
        }
    },
};
</script>
