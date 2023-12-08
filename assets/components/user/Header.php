<header style=" min-height: 70vh;">
    <?php
    require_once 'assets/components/user/Navbar.php';
    ?>

    <div class="container content row mx-auto flex-lg-row  flex-column-reverse align-items-center justify-content-center py-5">
        <lottie-player class="col-12 col-lg-6" src="https://lottie.host/07b83e48-e64d-4da8-a8d8-b50ed2411583/iYdZ3AoVZG.json" background="##FFFFFF" style="width: 40%;" speed="1" style="width: 300px; height: 300px" loop autoplay direction="1" mode="normal"></lottie-player>
        <div class="sub-content col-12 col-lg-6 d-flex flex-column align-items-center">
            <h1 class="tagline text-center">
                <p style="color: var(--dark);">Reserve
                    <span style="color: var(--secondary);">Your</span>
                    <span style="color: var(--base)">Room</span>
                </p>
            </h1>
            <p class="second-tagline">Make your event become real!</p>
            <div class="search w-100 d-flex flex-column align-items-center">
                <form method="GET" action="#" class="mb-3" style="min-width: 55%;">
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control p-2" name="search">
                        <button class="btn btn-secondary">
                            <i class="fa-brands fa-searchengin"></i>
                        </button>
                    </div>
                </form>
                <div class="search-button d-flex justify-content-start gap-2">
                    <a href="#" class="btn btn-outline-secondary" style="padding: 10px 50px;">Cari Cepat!!</a>
                    <a href="#" class="btn btn-secondary" style="padding: 10px 50px;">Panduan</a>
                </div>
            </div>
        </div>
    </div>
</header>