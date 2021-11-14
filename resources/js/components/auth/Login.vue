<template>
    <div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card border-0 mb-0 auth-card">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <b>Log in with credentials</b>
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
                                        @click="login"
                                    >
                                        Sign in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-center">
                            <a
                                @click="$router.push('/auth/register')"
                                class="new-account-text"
                                ><b>Create new account</b></a
                            >
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
        };
    },
    methods: {
        async login() {
            try {
                this.$auth.login({
                    data: {
                        email: this.email,
                        password: this.password,
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
