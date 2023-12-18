<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Welcome Page</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;" data-aos="fade-right" data-aos-duration="3000">Rental <span class="text-info">Laptop</span></a>
    <form class="form-inline">
            <div class="dropdown show">
            <a class="navbar-brand mr-3 " style="color:#3C4858;text-decoration:none" href="/admin">{{ session()->get('nama') }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/admin/user">Data Users</a>
                <a class="dropdown-item" href="/admin/order">Data Orders</a>
                <a class="dropdown-item" href="/admin/laptop">Data Laptops</a>
                <a class="dropdown-item" href="/admin/question">Data Questions</a>
                <a class="dropdown-item" href="/logout">Logout</a>
              </div>
            </div>
        </form>
    </nav>
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-12 mt-5">
                <h1 class="heading mb-3">Data Order</h1>
               </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr  class="text-center">
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>ZIP</th>
                    <th>Address</th>
                    <th>Nama Laptop</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Total Price</th>
                    <th>Pickup Date</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                  @foreach ($data_order as $key => $data)
                  <tr class="text-center">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $data->nama_user }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>{{ $data->city }}</td>
                    <td>{{ $data->zip }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->nama_laptop }}</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->duration }}</td>
                    <td>{{ $data->totprice }}</td>
                    <td>{{ $data->pickupdate }}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                      <a style="color:blue"  href="/admin/order/edit/{{ $data->id }}">Edit</a>
                      <a style="color:red"  href="/admin/order/delete/{{ $data->id }}">Hapus</a>
                    </td>
                  </tr>
                  @endforeach
            </table>
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

    </script>
@include('sweetalert::alert')
</body>

</html>
