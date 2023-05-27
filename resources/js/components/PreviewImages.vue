<template>
    <label for="image_path" class="col-md-12 col-form-label text-md-end card mb-3">
        <div class="card-img-top__preview"></div>
    </label>
</template>

<script>
    export default {
        methods: {
            previewImage() {
                const image = document.querySelector("#image_path")

                console.log(image)
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }

</script>
