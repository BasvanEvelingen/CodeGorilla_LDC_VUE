<template>
<div>
  <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
    </video>
    <div class="container h-100">
        <div class="d-flex text-center h-100">
            <div class="my-auto w-100 text-white">
                <div class="dp">
                    <img src="img/logo.png">
                </div>  
                <span class="coming">
                <h2>Coming Soon</h2>
                </span>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
data: {
  image: "'/images/laptop.jpg'";
}
</script>

<style scoped>
.background {
  background-size: cover;
}
</style>
