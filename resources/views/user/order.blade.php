<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <title>Order Form</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;" data-aos="fade-right"
            data-aos-duration="3000">Rental <span class="text-info">Laptop</span></a>
    </nav>

    <div class="container" style="max-width:1200px;margin-top:3%;margin-bottom:10%" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Form</div>
                    <div class="card-body">
                        <form method="POST" action="/user/order">
                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="id_user" class="form-control"
                                        value="{{ session()->get('id_user') }}" readonly>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ session()->get('nama') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control"
                                        value="{{ session()->get('email') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ session()->get('phone') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="City" class="col-md-4 col-form-label text-md-right">City</label>

                                <div class="col-md-6">
                                    <select name="city" class="form-control">
                                        <option value="Banyumanik">Banyumanik</option>
                                        <option value="Ngesrep">Ngesrep</option>
                                        <option value="Jabungan">Jabungan</option>
                                        <option value="Pudakpayung">Pudakpayung</option>
                                        <option value="Padangsari">Padangsari</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zip" class="col-md-4 col-form-label text-md-right">ZIP Code</label>

                                <div class="col-md-6">
                                    <input name="zip" type="text" class="form-control" id="inputZip">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Full Address</label>

                                <div class="col-md-6">
                                    <input name="address" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Laptop" class="col-md-4 col-form-label text-md-right">Laptop</label>

                                <div class="col-md-6">
                                    <select id="laptop" name="laptop" onclick="calculate()" class="form-control required">
                                        <option value="">Pilih Laptop</option>
                                        @foreach ($data_laptop as $laptops)
                                            @if ($laptops->status == 'Ready'){
                                                <option id_laptop="{{ $laptops->id }}"
                                                    nama="{{ $laptops->nama_laptop }}" value="{{ $laptops->price }}">
                                                    {{ $laptops->nama_laptop }}</option>}
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price1day" class="col-md-4 col-form-label text-md-right">Price For 1
                                    Day</label>

                                <div class="col-md-6">
                                    <div style="display:none" id="greet"></div>
                                    <input type="hidden" name="id_laptop" id="id_laptop" value="">
                                    <input style="display:none" type="text" name="laptop" id="namalaptop" value="">
                                    <input type="text" class="form-control" name="dayprice" id="harga"
                                        readonly="readonly" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Duration" class="col-md-4 col-form-label text-md-right">Durasi</label>

                                <div class="col-md-6">
                                    <input name="duration" type="number" class="form-control" id="durasi"
                                        onkeyup="calculate()">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="totprice" class="col-md-4 col-form-label text-md-right">Total Price</label>

                                <div class="col-md-6">
                                    <input name="totprice" type="text" class="form-control" id="totprice" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Date" class="col-md-4 col-form-label text-md-right">Pickup Date</label>

                                <div class="col-md-6">
                                    <input name="pickupdate" class="form-control" type="date" value=""
                                        id="example-datetime-local-input">
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Order Now
                                    </button>
                                    <a class="btn btn-secondary" href="/user">Cancel</a>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.addEventListener('scroll', (e) => {
            const nav = document.querySelector('.navbar');
            if (window.pageYOffset > 0) {
                nav.classList.add("add-shadow");
            } else {
                nav.classList.remove("add-shadow");
            }
        });

        var usedNames = {};
        $("select[name='laptop'] > option").each(function() {
            if (usedNames[this.text]) {
                $(this).remove();
            } else {
                usedNames[this.text] = this.value;
            }
        });

        function notEmpty() {
            var e = document.getElementById("laptop");
            var strUser = e.options[e.selectedIndex].value;
            var strLaptop = e.options[e.selectedIndex].getAttribute('nama');
            var strLaptopId = e.options[e.selectedIndex].getAttribute('id_laptop');
            document.getElementById('greet').innerHTML = strUser;
            document.getElementById('harga').value = strUser;
            document.getElementById('namalaptop').value = strLaptop;
            document.getElementById('id_laptop').value = strLaptopId;
        }
        notEmpty()
        document.getElementById("laptop").onchange = notEmpty;

        function calculate(price) {
            var price = document.getElementById("harga").value;
            var duration = document.getElementById("durasi").value;
            var result = parseInt(price * duration);
            document.getElementById("totprice").value = result;
        }

        AOS.init();
        

    </script>
    @include('sweetalert::alert')
</body>

</html>
