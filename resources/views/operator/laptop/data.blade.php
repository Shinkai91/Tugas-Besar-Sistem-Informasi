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
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;" data-aos="fade-right" data-aos-duration="3000">Jakarta <span class="text-info">Laptop</span></a>
    <form class="form-inline">
            <div class="dropdown show">
            <a class="navbar-brand mr-3 " style="color:#3C4858;text-decoration:none" href="/operator">{{ session()->get('nama') }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/logout">Logout</a>
              </div>
            </div>
        </form>
    </nav>

    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-12">
                <h1 class="heading mb-3">Data Laptop On Process</h1>
               </div>
        </div>
    </div>

    <div class="container-fluid mb-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr  class="text-center">
                    <th>No</th>
                    <th>ID Laptop</th>
                    <th>Nama Laptop</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Operator</th>
                    <th>Opsi</th>
                  </tr>
                  @foreach ($data_laptop_process as $key => $data)
                  <tr class="text-center">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->nama_laptop }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->note }}</td>
                    <td>{{ session()->get('nama') }}</td>
                    <td>
                      <a class="btn btn-secondary"href="/operator/laptop/edit/{{ $data->id }}">Edit</a>
                    </td>
                  </tr>
                  @endforeach
            </table>
          </div>

    </div>



    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-12">
                <h1 class="heading mb-3">Data Laptop</h1>
               </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr  class="text-center">
                    <th>No</th>
                    <th>ID Laptop</th>
                    <th>Nama Laptop</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Operator</th>
                    <th>Opsi</th>
                  </tr>
                  @foreach ($data_laptop_available as $key => $data)
                  <tr class="text-center">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->nama_laptop }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->note }}</td>
                    <td>{{ $data->id_operator }}</td>
                    <td>
                        <form action="/operator/laptop/add/{{ $data->id }}" method="POST">
                            @csrf
                            @if ($data->status ==="Finished")
                                <button class="btn btn-primary" type="submit">Add</button>
                            @endif
                        </form>
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
