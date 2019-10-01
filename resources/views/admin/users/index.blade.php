        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(session('notification'))
                        <div class="alert alert-success" style="position: relative; clear: both; width: 40%;"> 
                            {{ session('notification') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Level</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $item)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ ($item['gender']==1) ? 'Nam':'Nữ'}}</td>
                                    <td>{{ ($item['level']==0) ? 'Khách hàng':(($item['level']==1) ? 'Employee':'Admin') }}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ Route('admin.user.destroy', $item->id) }}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ Route('admin.user.edit', $item->id) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection

