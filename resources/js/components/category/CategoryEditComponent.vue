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
                                v-model="categoryData.name"
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
                                v-model="categoryData.isPublish"
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
                <button @click="updateCategory" class="btn btn-primary btn-sm">
                    <i class="fas fa-save mr-1"></i>
                    Update
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { Toast } from "vant";
export default {
    props: ["id"],
    data() {
        return {
            categoryData: {},
            photoUploader: [],
            iconUploader: [],
        };
    },
    methods: {
        async fetchCategoryById() {
            try {
                const res = await axios.get(`/api/categories/${this.id}`);
                this.categoryData = res.data.data;
                let image = {};
                image.url = res.data.data.image;
                let icon = {};
                icon.url = res.data.data.icon;
                this.photoUploader.push(image);
                this.iconUploader.push(icon);
            } catch (error) {
                console.log(error);
            }
        },
        async updateCategory() {
            if (this.photoUploader[0] && this.iconUploader[0]) {
                if (this.photoUploader[0].url) {
                    this.categoryData.image = this.photoUploader[0].url;
                } else {
                    this.categoryData.image = this.photoUploader[0].content;
                }
                if (this.iconUploader[0].url) {
                    this.categoryData.icon = this.iconUploader[0].url;
                } else {
                    this.categoryData.icon = this.iconUploader[0].content;
                }
            }
            try {
                const res = await axios.put(
                    `/api/categories/${this.id}`,
                    this.categoryData
                );
                this.$router.push("/category/index");
                Toast.success("Success");
            } catch (error) {
                Toast.fail("Fail");
            }
        },
    },
    created() {
        this.fetchCategoryById();
    },
};
</script>
<style scoped>
.custom-file {
    height: auto;
}
</style>
