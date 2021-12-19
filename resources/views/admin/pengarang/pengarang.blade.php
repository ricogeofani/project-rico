@extends('layouts.admin')
 
@push('css')
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('header', 'pengarang')

@section('content')
<component id="controller">
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Add Pengarang</a>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Pengarang</th>
                                <th>Email Pengarang</th>
                                <th>Telp Pengarang</th>
                                <th>Alamat Pengarang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form :action="actionUrl" method="post" autocomplete="of" @submit="submitForm($event, data.id)">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="!editStatus">Add Pengarang</h4>
                        <h4 class="modal-title" v-if="editStatus">Edit Pengarang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="put" v-if="editStatus">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Pengarang</label>
                            <input type="text" class="form-control" name="nama" :value="data.nama_pengarang" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" :value="data.email" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">Telp</label>
                            <input type="text" class="form-control" name="telp" :value="data.telp" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" :value="data.alamat" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</component>
@endsection 

@push('js')
    {{-- data table --}}
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

        <script type="text/javascript">
            var actionUrl = '{{ url('data/pengarang') }}';
            var columns = [
                {data: 'nama_pengarang', class: 'text-center', orderable: true},
                {data: 'email', class: 'text-center', orderable: true},
                {data: 'telp', class: 'text-center', orderable: true},
                {data: 'alamat', class: 'text-center', orderable: true},
                {render: function(index, row, data, meta){
                    return `
                    <div class="d-flex">
                        <a href="#" class="btn btn-sm btn-warning rounded-pill" onclick="controller.editData(event, ${meta.row})">
                            Update
                        </a>
                        <a href="#" class="btn btn-danger btn-sm rounded-pill" onclick="controller.deleteData(event, ${data.id})">
                            Delete
                        </a>
                    </div>
                    `;
                }, orderable: false, width: '100px', class: 'text-center'},
            ];

         </script>
        <script  src="{{ asset('js/data.js') }}"></script>
@endpush 
 








{{-- @extends('layouts.admin')
@section('header', 'pengarang')

@push('css')
    <style type="text/css"></style>
@endpush
@section('content')
    <component id="controller">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Add Pengarang</a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Pengarang</th>
                                    <th>Email Pengarang</th>
                                    <th>Telp Pengarang</th>
                                    <th>Alamat Pengarang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_pengarangs as $num => $pengarang )
                            <tr>
                                <td>{{ $num+1 }}.</td>
                                <td>{{ $pengarang->nama_pengarang }}</td>
                                <td>{{ $pengarang->email }}</td>
                                <td>{{ $pengarang->telp }}</td>
                                <td>{{ $pengarang->alamat }}</td>
                                <td class="text-right">
                                        <a href="#" @click="editData({{ $pengarang }})" class="btn btn-sm btn-warning rounded-pill">Update</a>
                                       <a href="#" @click.prevent="deleteData({{ $pengarang->id }})" class="btn btn-sm btn-danger rounded-pill">Delete</a>
                                </td>
                            </tr> 
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form :action="actionURL" method="POST" autocomplete="of">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="!editStatus">Add Pengarang</h4>
                            <h4 class="modal-title" v-if="editStatus">Edit Pengarang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_method" value="put" v-if="editStatus">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Pengarang</label>
                                <input type="text" class="form-control" name="nama" :value="data.nama_pengarang" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" :value="data.email" required>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control" name="telp" :value="data.telp" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" :value="data.alamat" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </component>
@endsection

@push('js')
<script type="text/javascript">
    var app = new Vue({
        el: '#controller',
        data: {
            editStatus: false,
            data: {},
            actionURL: ''
        },
        mounted: function() {

        },
        methods: {
            addData() {
                this.editStatus = false;
                this.data = {};
                this.actionURL = '{{ url('data/pengarang') }}';
                $('#modal-default').modal();
            },
            editData(pengarang) {
                this.editStatus = true;
                this.data = pengarang;
                this.actionURL = '{{ url('data/pengarang') }}' + '/' + pengarang.id;
                $('#modal-default').modal();
            },
            deleteData(id) {
                this.actionURL = '{{ url('data/pengarang') }}';
                if(confirm('Are you sure ?')){
                    axios.post(this.actionURL + '/' + id, {_method: 'DELETE'}).then((response) => {
                        location.reload();
                    });
                }
            }
        }
    });
</script>
@endpush --}}