<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل ادمین</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('styleSheets.dataStyle')
    @include('styleSheets.styleSheets')
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

        @include('header.data.usersData_header')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="accordionHead">
                                <form role="form" method="get" action="{{ route('admin_users.filter') }}">
                                    @csrf
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <a class="btn btn-secondary" data-bs-toggle="collapse" href="#fillters">
                                                فیلتر ها
                                            </a>
                                        </div>
                                        <div class="collapse" id="fillters" data-bs-parent="#accordionHead">
                                            <div class="card-body">
                                                <div class="form-control">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="email">ایمیل</label>
                                                                <input type="text" class="form-control"
                                                                       id="email" name="filter[email]"
                                                                       placeholder="email"
                                                                       @if (isset($_GET['email'])) value="{{ $_GET['email'] }}" @endif>
                                                            </div>

                                                            <div class="col">
                                                                <label for="first_name">نام</label>
                                                                <input type="text" class="form-control"
                                                                       id="first_name" name="filter[first_name]"
                                                                       placeholder="نام"
                                                                       @if (isset($_GET['first_name'])) value="{{ $_GET['first_name'] }}" @endif>
                                                            </div>
                                                            <div class="col">
                                                                <label for="last_name">نام خانوادگی</label>
                                                                <input type="text" class="form-control"
                                                                       id="last_name" name="filter[last_name]"
                                                                       placeholder="نام خانوادگی"
                                                                       @if (isset($_GET['last_name'])) value="{{ $_GET['last_name'] }}" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="user_name">نام کاربری</label>
                                                        <input type="text" class="form-control" id="user_name"
                                                               name="filter[user_name]" placeholder="نام کاربری"
                                                               @if (isset($_GET['user_name'])) value="{{ $_GET['user_name'] }}" @endif>
                                                    </div>
                                                    <div class="col">
                                                        <label for="phone_number">شماره همراه</label>
                                                        <input type="number" class="form-control" id="phone_number"
                                                               name="filter[phone_number]" placeholder="9120000000"
                                                               @if (isset($_GET['phone_number'])) value="{{ $_GET['phone_number'] }}" @endif>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="filterAge">سن</label>
                                                                <label for="filterAgeMin" id="filterAge">از</label>
                                                                <input type="number" class="form-control"
                                                                       id="filterAgeMin" name="filter[AgeMin]"
                                                                       placeholder="از"
                                                                       @if (isset($_GET['filterAgeMin'])) value="{{ $_GET['filterAgeMin'] }}" @endif>
                                                            </div>
                                                            <div class="col">
                                                                <label for="filterAgeMax">تا</label>
                                                                <input type="number" class="form-control"
                                                                       id="filterAgeMax" name="filter[AgeMax]"
                                                                       placeholder="تا"
                                                                       @if (isset($_GET['filterAgeMax'])) value="{{ $_GET['filterAgeMax'] }}" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="gender">جنسیت</label>
                                                        <select class="form-control" id="gender"
                                                                name="filter[gender]">
                                                            <option selected>
                                                            </option>
                                                            <option value="male"
                                                                    @if (isset($_GET['gender'])) @if ($_GET['gender'] == 'male')
                                                                        selected @endif
                                                                @endif>مرد
                                                            </option>
                                                            <option value="female"
                                                                    @if (isset($_GET['gender'])) @if ($_GET['gender'] == 'female')
                                                                        selected @endif
                                                                @endif>زن
                                                            </option>
                                                            <option value="other"
                                                                    @if (isset($_GET['gender'])) @if ($_GET['gender'] == 'other')
                                                                        selected @endif
                                                                @endif>سایر
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="post_code">کد پستی</label>
                                                        <input type="number" class="form-control" id="post_code"
                                                               name="filter[post_code]"
                                                               placeholder="کد پستی را وارد کنید"
                                                               @if (isset($_GET['post_code'])) value="{{ $_GET['post_code'] }}" @endif>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <buttom type="submit" class="btn btn-info">فیلتر</buttom>
                                        <a href="{{ route('admin_users.index') }}">
                                            <button type="button" class="btn btn-warning">حذف فیلتر
                                                ها</button>
                                        </a>
                                    </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                            <table id="Data" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>نام کاربری</th>
                                    <th>ایمیل</th>
                                    <th>شماره همراه</th>
                                    <th>شخصیت</th>
                                    <th>وضعیت تایید</th>
                                    <th>تایید</th>
                                    <th>رد</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->status}}</td>

                                        <td>
                                            @if($user->role == 'seller')
                                                <form action="{{route('users.accept',['id' => $user->id])}}"
                                                      method="post">
                                                    @csrf
                                                    <button type="submit" @if($user->status == 'تایید شده') disabled @endif >
                                                        <i class="fa-regular fa-pen-to-square fa-flip-horizontal"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->role == 'seller')

                                                <form action="{{route('users.reject',['id'=>$user->id])}}">
                                                    @csrf
                                                    <button type="submit"  @if($user->status == 'تایید شده') disabled @endif >
                                                        <i class="fa-regular fa-pen-to-square fa-flip-horizontal"></i>
                                                    </button>
                                                </form>

                                            @endif
                                        </td>
                                        <td>
                                            <form method="post" action="{{ route('admin_users.edit',['id'=>$user->id]) }}">
                                                @csrf
                                                @method('put')
                                                <button type="submit">
                                                    <i class="fa-regular fa-pen-to-square fa-flip-horizontal"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('admin_users.destroy',['id'=>$user->id])}}"
                                                  method="post">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    }
                                @endforeach
                                </tbody>
                            </table>
                            {{--                            {{ $users->onEachSide(3)->links() }}--}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- page script -->

</body>
</html>
