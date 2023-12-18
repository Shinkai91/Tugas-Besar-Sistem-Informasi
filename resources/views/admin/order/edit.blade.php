<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Edit Laptop</title>
</head>
<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;" data-aos="fade-right" data-aos-duration="3000">Rental <span class="text-info">Laptop</span></a>
    </nav>

  <div class="container" style="max-width:65%;margin-top:3%;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:20%;">
                <div class="card-header">Edit Data Order</div>
                <div class="card-body">
                    <form method="POST" action="/admin/order/update">
                        @csrf
                        <div class="form-group row">
                            <label for="nama_laptop"
                                class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="id" value="{{$data->id}}">
                                <input type="hidden" class="form-control" name="id_laptop" value="{{$data_orders->id_laptop}}">
                                <input type="text" class="form-control" name="nama_user" value="{{$data->nama_user}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Price" class="col-md-4 col-form-label text-md-right">Price</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" value="{{$data->email}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" value="{{$data->phone}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="City" class="col-md-4 col-form-label text-md-right">City</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city" value="{{$data->city}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Zip" class="col-md-4 col-form-label text-md-right">ZIP</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="zip" value="{{$data->zip}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" value="{{$data->address}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Zip" class="col-md-4 col-form-label text-md-right">Nama Laptop</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nama_laptop" value="{{$data->nama_laptop}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Zip" class="col-md-4 col-form-label text-md-right">Price</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="price" value="{{$data->price}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Zip" class="col-md-4 col-form-label text-md-right">Duration</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="duration" value="{{$data->duration}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Zip" class="col-md-4 col-form-label text-md-right">Total Price</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="totprice" value="{{$data->totprice}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Zip" class="col-md-4 col-form-label text-md-right">Pickup Date</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="pickupdate" value="{{$data->pickupdate}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Status" class="col-md-4 col-form-label text-md-right">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option value="Pending" @if($data->status === 'Pending') selected @endif>Pending</option>
                                    <option value="On Process" @if($data->status === 'On Process') selected @endif>On Process</option>
                                    <option value="Finished" @if($data->status === 'Finished') selected @endif>Finished</option>
                                  </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a class="btn btn-secondary" href="/admin/order">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
  <script>
    window.addEventListener('scroll',(e)=>{
      const nav = document.querySelector('.navbar');
      if(window.pageYOffset>0){
        nav.classList.add("add-shadow");
      }else{
        nav.classList.remove("add-shadow");
      }
    });
  </script>
@include('sweetalert::alert')
</body>
</html>