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

    <title>Welcome Page</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;">Rental <span class="text-info">Laptop</span></a>
        <form class="form-inline">
            <div class="dropdown show">
                <a class="navbar-brand mr-3 " style="color:#3C4858;text-decoration:none"
                    href="{{ route('logout') }}">{{ session()->get('nama') }}</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/user">Home</a>
                    <a class="dropdown-item" href="/user/order">Order</a>
                    <a class="dropdown-item" href="/user/history">History</a>
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>
        </form>
    </nav>

    <div class="container" style="max-width:1200px;margin-top:3%;margin-bottom:10%" data-aos="fade-up">
        <div class="row justify-content-center">
            <form class="form-inline mb-4 justify-content-center">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="container-fluid">
                <div class="table-responsive">
                    <h2>History</h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Laptop</th>
                                <th>PickUp Date</th>
                                <th>Durasi (Hari)</th>
                                <th>Total Harga</th>
                                <th>Alamat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_order as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->nama_laptop }}</td>
                                    <td>{{ $item->pickupdate }}</td>
                                    <td>{{ $item->duration }}</td>
                                    <td>{{ $item->totprice }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14">Your History is Empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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

        AOS.init();
    </script>

    @include('sweetalert::alert')
</body>

</html>
