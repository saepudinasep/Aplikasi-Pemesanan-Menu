@extends('layouts.mainlayout')

@section('title', 'Member')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Member</h1>
    <button class="btn btn-primary" onclick="create()">
        <i class="fas fa-plus-circle"></i>
        Add Data
    </button>

    <div class="d-flex justify-content-end">
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="keyword" placeholder="Search....">
                <div class="input-group-append">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Member</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="read-member">

                </div>
            </div>
        </div>
    </div>









    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div id="page" class="p-2"></div>
            </div>
        </div>
        </div>
    </div>



    <script>
        $(document).ready(function(){
            read();
        });


        // Read Database
        function read() {
            $.get("{{ url('read-member') }}", {}, function(data, status) {
                $("#read-member").html(data);
            });
        }

        // untuk modal halaman create
        function create() {
            $.get("{{ url('create-member') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Add Member');
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }


        // untuk proses data create
        function store() {
            var name = $("#name").val();
            var email = $("#email").val();
            var handphone = $("#handphone").val();
            $.ajax({
                type:"get",
                url:"{{ url('store-member') }}",
                data:{name:name, email:email, handphone:handphone},
                success:function(data){
                    // $("#page").html('');
                    $(".close").click();
                    read();
                }
            });
        }


    </script>




@endsection
