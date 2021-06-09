@include('frontend.head')
@include('frontend.nav')

<main id="main">


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

        <div class="container" data-aos="fade-up">

            <header class="section-header mt-4">
                <p>Register</p>
                <h2 class="mt-2">Lengkapi form di bawah ini</h2>
            </header>

            <div class="row">

                <div class="col-md-12">

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            @if (session('sukses'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('sukses') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="col-md-12">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="number" name="telepon" class="form-control" placeholder="Telepon" required>
                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <textarea class="form-control" name="alamat_ktp" rows="4" placeholder="Alamat"
                                    required></textarea>
                                @error('alamat_ktp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                {{-- <div class="loading">Loading</div> --}}
                                {{-- @if (session('error')) --}}
                                {{-- <div class="error-message">{{session('error')}}</div> --}}
                                {{-- @endif
                                @if (session('sukses')) --}}
                                {{-- <div class="sent-message">{{session('sukses')}}!</div> --}}
                                {{-- @endif --}}
                                <button class="btn btn-lg btn-primary" type="submit">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
@include('frontend.script')
