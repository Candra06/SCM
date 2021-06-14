@include('frontend.head')

<body>

    @include('frontend.nav')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">De Prima Bondowoso</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Hunian Islami Pertama dan Terlengkap di Bondowoso</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Pemesanan</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ url('/') }}/assets/frontend/img/ilustrasi_dpb_2021.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang De Prima Bondowoso</h3>

                            <p>
                                Primaland merupakan perusahaan yang bergerak di bidang developer, konsultan, dan design.
                                Perusahaan ini dirintis pada tahun 2008, berawal dari usaha mengelola dan memasarkan
                                beberapa unit rumah dan ruko. Beberapa proyek yang dikerjakan oleh Primaland antara lain
                                11 unit rumah kos dan 6 unit rumah di jalan sigura-gura Malang, perumahan di Mondoroko
                                Indah Inside, Simpang Borobudur, dan lain-lain.
                            </p>
                            <p>
                                Primaland terus maju dan berkembang seiring dengan pesatnya pertumbuhan property,
                                khususnya di kota Malang. Mulai tahun 2016, Primaland membangun de Prima Tunggul wulung
                                yang merupakan Hunian Islami Pertama di Kota Malang. Primaland sebagai developer hunian
                                Islami berkomitmen untuk mengembangkan hunian Islami yang berkualitas dengan lingkungan
                                yang kondusif, dan cara pembayaran yang syar’i.
                            </p>

                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{url('/')}}/assets/frontend/img/logo2.png" class="img-fluid" alt="">
                    </div>

                </div>
            </div>

        </section><!-- End About Section -->



        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Produk</h2>
                    <p>Macam-macam Tipe Rumah dan Kavling Tersedia</p>
                </header>

                <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="card testimonial-item">

                               @foreach ($data as $item)
                               <img class="card-img-top" src="{{asset("storage/desain/".$item->desain_rumah)}}" alt="Card image cap">
                               <div class="card-body">
                                   <h5 class="card-title">{{ $item->nama_kavling . ' ' . $item->no_kavling }}</h5>
                                   <div style="float:right;">

                                 </div>
                                <div style="text-align:left;">
                                   <label for=""> Tipe Rumah</label>
                                    <p class="card-text"><b>{{ $item->nama_tipe }}</b></p>
                                </div>
                               <div style="text-align: left">
                                    <label for="">Jumlah Lantai</label>
                                    <p class="card-text"><b>{{ $item->jumlah_lantai }}</b></p>
                                </div>
                                <div style="text-align: left">
                                    <label for="">Harga Jual</label>
                                    <p class="card-text"><b>{{ Helper::price($item->harga_jual) }}</b></p>
                                </div>
                                   {{-- <a href="{{url('/pemesanan/1')}}" class="btn btn-primary">Pesan Sekarang</a> --}}
                               </div>
                               @endforeach

                            </div>
                        </div><!-- End testimonial item -->



                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- End Testimonials Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Contact</h2>
                    <p>Contact Us</p>
                </header>

                <div class="row">

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="info-box">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Address</h3>
                                    <p>Desa Pejaten Dukuh Krajan RT 03 RW 01 kec Bondowoso, <br>kab Bondowoso, Bondowoso
                                        68218,</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Call Us</h3>
                                    <p>08113755555</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>deprimabondowoso@gmail.com</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box">
                                    <i class="bi bi-clock"></i>
                                    <h3>Open Hours</h3>
                                    <p>Senin - Sabtu. 08:00 - 16:00</p>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>

        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    @include('frontend.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('frontend.script')

</body>

</html>
