<template>
    <div>
        <div class="nav d-flex justify-content-end bg-secondary pt-3">
            <ul class="ml-lg-auto d-flex">
                <li>
                    <div class="nav-link nav-link-icon" href="#">
                        <span class="nav-link-inner--text">
                            <button
                                class="btn btn-primary"
                                @click="$router.push('/auth/login')"
                            >
                                <i class="fas fa-sign-in-alt mr-1"></i>Login
                            </button>
                        </span>
                    </div>
                </li>
                <li>
                    <div class="nav-link nav-link-icon" href="#">
                        <span class="nav-link-inner--text">
                            <button
                                class="btn btn-primary"
                                @click="$router.push('/auth/register')"
                            >
                                <i class="fas fa-user-plus mr-1"></i>Register
                            </button>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card">
            <img src="/assets/homephoto.jpg" alt="">
        </div>
    </div>
</template>
<script>
import { Toast, Dialog, Sticky } from "vant";

export default {
    components: { Sticky },
    data() {
        return{
            
        }
    }
};
</script>
<style scoped>
.nav-link {
    cursor: pointer;
}
.navbar-brand.brand-text {
    font-size: 20px;
    color: red;
    margin-left: 0px;
    margin-right: 10px;
}
.navbar-brand {
    font-size: 16px;
    margin-left: 20px;
    margin-right: 20px;
    cursor: pointer;
}
.dropdown-item {
    cursor: pointer;
}
@media (max-width: 767.98px) {
    .navbar-brand {
        font-size: 14px;
        margin-left: 0px;
        margin-right: 0px;
    }
}
</style>
