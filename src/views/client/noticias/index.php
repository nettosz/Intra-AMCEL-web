<div class="container-master">
    <div class="agendamento-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: #fff; padding: .75rem 0px; margin-bottom: 0px">
                <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nóticias</li>
            </ol>
        </nav>
        <hr />


        <div class="container-slider" style="margin-bottom: 80px;">
            <div class="title">
                <h3>Notícias</h3>
            </div>
            <div class="wrapper-slides" style="width: 100%;">
                <div class="swiper mySwiper" style="width: 79%;">
                    <div class="swiper-wrapper">
                        <?php foreach ($slide1 as $s) : ?>
                            <a href="<?= $s['link']; ?>" class="swiper-slide" target="_blank">
                                <img style="width: 100%; height: 320px" src="assets/imgs/noticias/<?= $s['nome_arquivo'] ?>" alt="" />
                                <h4><?= $s['titulo'] ?></h4>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($slide2 as $s) : ?>
                            <a href="<?= $s['link']; ?>" class="swiper-slide" target="_blank">
                                <img style="width: 100%; height: 320px" src="assets/imgs/noticias/<?= $s['nome_arquivo'] ?>" alt="" />
                                <h4><?= $s['titulo'] ?></h4>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div> -->
            </div>

            <!-- <div class="wrapper-slides"> -->
            <!-- <div class="swiper-container mySwiper" style="margin: 10px;">
                    <div class="swiper-wrapper">
                        <?php foreach ($slide1 as $s) : ?>
                            <a href="<?= $s['link']; ?>" class="swiper-slide" target="_blank">
                                <img style="width: 100%; height: 320px" src="assets/imgs/noticias/<?= $s['nome_arquivo'] ?>" alt="" />
                                <h4><?= $s['titulo'] ?></h4>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>

                </div> -->

            <!-- <div class="swiper-container mySwiper1" style="margin: 10px;">
                    <div class="swiper-wrapper">
                        <?php foreach ($slide2 as $s) : ?>
                            <a href="<?= $s['link']; ?>" class="swiper-slide" target="_blank">
                                <img style="width: 100%; height: 320px" src="assets/imgs/noticias/<?= $s['nome_arquivo'] ?>" alt="" />
                                <h4><?= $s['titulo'] ?></h4>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div> -->
            <!-- </div> -->
        </div>

    </div>
</div>