<template>
    <div class="container my-5">
        <div class="card">
            <h5 class="card-header">Category information</h5>
            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="form-row">
                        <div class="col">
                            <label for="">
                                <span class="text-danger">*</span> Category
                                Name</label
                            >
                            <input
                                v-model="category.name"
                                type="text"
                                class="form-control"
                            />
                        </div>
                        <div class="col">
                            <label for=""
                                ><span class="text-danger">*</span> Category
                                Photo</label
                            >
                            <div class="custom-file d-flex">
                                <van-uploader
                                    class="mx-auto"
                                    v-model="photoUploader"
                                    :max-count="1"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-5 ml-1 container">
                        <div class="col">
                            <input
                                type="checkbox"
                                v-model="category.isPublish"
                                class="form-check-input"
                            />
                            <label for="" class="form-check-label"
                                >Status(Is Publish?)</label
                            >
                        </div>
                        <div class="col">
                            <label for=""
                                ><span class="text-danger">*</span> Category
                                Icon</label
                            >
                            <div class="custom-file d-flex">
                                <van-uploader
                                    class="mx-auto"
                                    v-model="iconUploader"
                                    :max-count="1"
                                />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button @click="saveCategory" class="btn btn-primary btn-sm">
                    <i class="fas fa-save mr-1"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { Toast } from "vant";
export default {
    data() {
        return {
            photoUploader: [],
            iconUploader: [],
            category: {
                isPublish: false,
            },
        };
    },
    methods: {
        async saveCategory() {
            if (this.photoUploader[0] && this.iconUploader[0]) {
                this.category.image = this.photoUploader[0].content;
                this.category.icon = this.iconUploader[0].content;
            }

            try {
                const res = await axios.post("/api/categories", this.category);
                Toast.success("Success");
                this.$router.push("/category/index");
            } catch (error) {
                Toast.fail("Fail");
            }
        },
    },
};
</script>
<style scoped>
.custom-file {
    height: auto;
}
</style>
