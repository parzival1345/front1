<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | جدول داده</title>
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

        @include('header.data.ordersData_header')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container">
                                <table id="Data" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>اسم سفارش</th>
                                        <th>مشتری</th>
                                        <th>لیست محصولات</th>
                                        <th>قیمت کل</th>
                                        <th>ویرایش</th>
                                        <th>حذف</th>
                                        <th>صدور فاکتور</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($temp = 0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->title}}</td>
                                            <td>
                                                <a class="btn" data-bs-toggle="collapse"
                                                   href="#collapseC{{$order->user_id}}{{$temp}}">
                                                    {{$order->user_id}}
                                                </a>
                                                <div id="collapseC{{$order->user_id}}{{$temp++}}"
                                                     class="collapse"
                                                     data-bs-parent="#accordion">
                                                    <div class="card-body">
                                                        <table>
                                                            <tr>
                                                                <th>{{$order->user->user_name}}
                                                                    {{$order->user->last_name}}</th>
                                                                <th>{{$order->user->email}}</th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn" data-bs-toggle="collapse"
                                                   href="#collapseP{{$order->id}}">
                                                    All products
                                                </a>
                                                <div id="collapseP{{$order->id}}" class="collapse"
                                                     data-bs-parent="#accordion">
                                                    <div class="card-body">
                                                        <table>
                                                            @foreach($order->products as $product)
                                                                <tr>
                                                                    <td>name : {{$product->product_name}}</td>
                                                                    <td>price : {{$product->price}}</td>
                                                                    <td>count : {{$product->pivot->count}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>
                                                <form class="" action="{{route('customer_orders.edit',['id'=>$order->id])}}"
                                                      method="get">
                                                    <button type="submit">
                                                        <i class="fa-regular fa-pen-to-square fa-flip-horizontal"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="" action="{{route('customer_orders.destroy',['id'=>$order->id])}}"
                                                      method="post">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Are you sure?')">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="" action="{{route('customer_factors.create',['id'=>$order->id])}}"
                                                      method="get">
                                                    <button type="submit">
                                                        <i class="fa-regular fa-pen-to-square fa-flip-horizontal"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>مشتری</th>
                                        <th>فروشنده</th>
                                        <th>توضیحات</th>
                                        <th>لیست محصولات</th>
                                        <th>قیمت کل</th>
                                        <th>ویرایش</th>
                                        <th>حذف</th>
                                        <th>صدور فاکتور</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
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

<script>
    $(function () {
        $('#Data').DataTable({
            "language":
                {
                    "paginate":
                        {
                            "next": "بعدی",
                            "previous": "قبلی"
                        },
                    "search": "جست و جو : ",
                },

            "info": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "autoWidth": true
        });
    });
</script>

</body>
</html>
