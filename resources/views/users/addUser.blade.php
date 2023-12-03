<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | کاربر جدید</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('styleSheets.styleSheets')
    {{--    <link rel="stylesheet" href="{{asset('persenalCss/app.css')}}">--}}
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    @include('navbar.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        @include('Sidebar.Sidebar')
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        @include('header.adding.addUser_header')
        <!-- /.content-header -->
        <!-- Main row -->
        <section class="content">
            <!-- form start -->
            <div class="container-fluid">
                <form role="form" method="post" action="{{route('users.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="email">ایمیل</label>
                                    <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email"
                                           placeholder="ایمیل را وارد کنید">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="first_name">نام</label>
                                    <input type="text" class="form-control" value="{{old('first_name')}}"id="first_name" name="first_name"
                                           placeholder="نام">
                                    @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input type="text" class="form-control" value="{{old('last_name')}}"id="last_name" name="last_name"
                                           placeholder="نام خانوادگی">
                                    @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="user_name">نام کاربری</label>
                                        <input type="text" class="form-control" value="{{old('user_name')}}" id="user_name" name="user_name"
                                           placeholder="نام کاربری">
                                    @error('user_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="phone_number">شماره همراه</label>
                                    <input type="text" class="form-control" value="{{old('phone_number')}}" id="phone_number" name="phone_number"
                                           placeholder="09123456789">
                                    @error('phone_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="age">سن</label>
                                    <input type="number" class="form-control" value="{{old('age')}}" id="age" name="age"
                                           min="0" placeholder="سن را وارد کنید">
                                    @error('age')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="gender">جنسیت</label>
                                    <select class="form-control"  value="{{old('gender')}}"id="gender" name="gender">
                                        <option value="male" selected>مرد</option>
                                        <option value="female">زن</option>
                                        <option value="other">سایر</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="postal_code">کد پستی</label>
                                    <input type="number" class="form-control" value="{{old('postal_code')}}" id="postal_code" name="postal_code"
                                           placeholder="کد پستی را وارد کنید">
                                    @error('postal_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="country">کشور</label>
                                    <input type="text" class="form-control" value="{{old('country')}}" id="country" name="country"
                                           placeholder="کشور خود را وارد کنید">
                                    @error('country')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="province">استان</label>
                                    <input type="text" class="form-control" value="{{old('province')}}" id="province" name="province"
                                           placeholder="استان خود را وارد کنید">
                                    @error('province')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="city">شهر</label>
                                    <input type="text" class="form-control" value="{{old('city')}}" id="city" name="city"
                                           placeholder="شهر خود را وارد کنید">
                                    @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">آدرس</label>
                            <input type="text" class="form-control" value="{{old('address')}}" id="address" name="address"
                                   placeholder="آدرس را وارد کنید">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="password">رمز عبور</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                           name="password" type="password"
                                           pattern="^\S{6,}$"
                                           placeholder="Password">

                                </div>
                                <div class="col">
                                    <label for="password_confirmation">تکرار پسورد</label>
                                    <input class="form-control" id="password_confirmation" name="password_confirmation"
                                           type="password"
                                           pattern="^\S{6,}$"
                                           placeholder="Verify Password">
                                </div>
                            </div>
                            <br>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <!-- /.card -->


    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->

<!-- /.content-wrapper -->

@include('.footer.main_footer')

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- ./wrapper -->
@include('.scripts')
</body>

</html>
