<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | کاربر جدید</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('styleSheets.styleSheets')
    <link rel="stylesheet" href="{{asset('persenalCss/app.css')}}">
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
        @include('header.editingData.editing_user')
        <!-- /.content-header -->
        <!-- Main row -->
        <section class="content">
            <!-- form start -->
            <div class="container-fluid">
                <form role="form" method="post" action="{{route('admin_users.update',['id' => $users->id])}}">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="{{$users->email}}" value="{{$users->email}}">
                        </div>
                        <div class="form-group">
                            <label for="first_name">نام</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   placeholder="{{$users->first_name}}" value="{{$users->first_name}}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   placeholder="{{$users->last_name}}" value="{{$users->last_name}}">
                        </div>
                        <div class="form-group">
                            <label for="user_name">نام کاربری</label>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                   placeholder="{{$users->user_name}}" value="{{$users->user_name}}">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">شماره همراه</label>
                            <input type="number" class="form-control" id="phone_number" name="phone_number"
                                   placeholder="{{$users->phone_number}}" value="{{$users->phone_number}}">
                        </div>

                        <!-- Add the remaining input fields -->
                        <div class="form-group">
                            <label for="age">سن</label>
                            <input type="number" class="form-control" id="age" name="age"
                                   placeholder="{{$users->age}}" value="{{$users->age}}">
                        </div>

                        <div class="form-group">
                            <label for="gender">جنسیت</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="male" @if($users->gender == "male") selected @endif>مرد</option>
                                <option value="female" @if($users->gender == "female") selected @endif>زن</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="postal_code">کد پستی</label>
                            <input type="number" class="form-control" id="postal_code" name="postal_code"
                                   placeholder="{{$users->post_code}}" value="{{$users->post_code}}">
                        </div>

                        <div class="form-group">
                            <label for="address">آدرس</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="{{$users->address}}" value="{{$users->address}}">
                        </div>
                        <div class="form-group">
                            <label for="country">کشور</label>
                            <input type="country" class="form-control" id="country" name="country"
                                   placeholder="{{$users->country}}" value="{{$users->country}}">
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
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('footer.main_footer')

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('scripts')
</body>

</html>
