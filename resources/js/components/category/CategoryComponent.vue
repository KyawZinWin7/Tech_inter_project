<template>
    <div class="containter my-5">
        <div class="row mb-3">
            <div class="container d-flex">
                <div class="col d-flex justify-content-between">
                    <button
                        class="btn btn-primary"
                        @click="$router.push('/category/create')"
                    >
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
                    <button class="btn btn-danger" @click="logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input
                            type="text"
                            placeholder="Search By Category Name"
                            class="form-control"
                            v-model="searchKeyword"
                        />
                        <div class="input-group-append">
                            <button
                                class="btn btn-primary"
                                @click="searchCategory"
                            >
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Publish</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in categories" :key="category.id">
                            <th scope="row">{{ category.id }}</th>
                            <td>{{ category.name }}</td>
                            <td>
                                <img
                                    :src="category.image"
                                    alt=""
                                    class="image-container"
                                />
                            </td>
                            <td>
                                <img
                                    :src="category.icon"
                                    alt=""
                                    class="image-container"
                                />
                            </td>
                            <td>
                                <i
                                    class="far fa-edit text-primary"
                                    @click="
                                        $router.push(
                                            `/category/edit/${category.id}`
                                        )
                                    "
                                ></i>
                            </td>
                            <td>
                                <i
                                    class="far fa-trash-alt text-danger"
                                    @click="deleteCategory(category.id)"
                                ></i>
                            </td>
                            <td>
                                <button
                                    class="btn btn-success btn-sm"
                                    @click="publishOrNot(category)"
                                    v-if="category.isPublish"
                                >
                                    Published
                                </button>
                                <button
                                    class="btn btn-danger btn-sm"
                                    @click="publishOrNot(category)"
                                    v-if="!category.isPublish"
                                >
                                    UnPublished
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { Toast, Dialog } from "vant";
export default {
    data() {
        return {
            categories: [],
            searchKeyword: null,
        };
    },
    methods: {
        async searchCategory() {
            try {
                const res = await axios.get("api/categories/", {
                    params: {
                        search: this.searchKeyword,
                    },
                });
                this.categories = res.data.data;
            } catch (error) {}
        },
        publishOrNot(data) {
            Dialog.confirm({
                title: "Are you sure want to update status?",
                cancelButtonText: "Cancel",
                confirmButtonText: "Sure",
            })
                .then(() => {
                    this.publish(data);
                })
                .catch(() => {});
        },
        async publish(data) {
            let newData = data;
            newData.isPublish = !newData.isPublish;
            try {
                const res = await axios.put(
                    `api/categories/${data.id}`,
                    newData
                );
                Toast.success("Success");
            } catch (error) {
                Toast.fail("Fail");
            }
        },
        deleteCategory(id) {
            Dialog.confirm({
                title: "Are you sure want to delete?",
                cancelButtonText: "Cancel",
                confirmButtonText: "Sure",
            })
                .then(() => {
                    this.delete(id);
                })
                .catch(() => {});
        },
        async delete(id) {
            try {
                const res = await axios.delete(`api/categories/${id}`);
                Toast.success("Success");
                this.view();
            } catch (error) {
                Toast.fail("Fail");
            }
        },
        async view() {
            try {
                const res = await axios.get("/api/categories");
                this.categories = res.data.data;
            } catch (error) {
                console.log(error);
            }
        },
        logout() {
            Dialog.confirm({
                title: "Are you sure to log out?",
                cancelButtonText: "Cancel",
                confirmButtonText: "Sure",
            })
                .then(() => {
                    this.$auth.logout({
                        redirect: "/",
                    });
                    Toast.success("Logged out!");
                })
                .catch(() => {});
        },
    },
    watch: {
        searchKeyword() {
            if (this.searchKeyword === "") {
                this.view();
            }
        },
    },
    created() {
        this.view();
    },
};
</script>

<style>
.image-container {
    height: 50px;
    width: 50px;
    border: 1px solid rgb(197, 189, 189);
    border-radius: 5px;
}
td {
    cursor: pointer;
}
</style>
