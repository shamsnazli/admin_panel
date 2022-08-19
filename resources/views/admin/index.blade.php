@extends('layouts.main')

@section('MainContent')
<div class="card">
    <div class="card-header">
        <h4>{{$title}} </h4>
    </div>
        <div class="card-body">   
        <a href="#" class="btn btn-success" id="AddBook" >Add New Book</a>
            {!! $dataTable->table([
                'class'=>'dataTable table table-striped table-hover table-bordered' ,
                'id'=>'datatable'
            ]) !!}

        <div>
            @include('admin.form_modal')
        </div>
        </div>
        
    
</div>

@push('js')
    {!! $dataTable->scripts() !!}


<script >
        $(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
            });
        $('#AddBook').on('click', function(){
            $('#modelHeading').html("Add New Book");
            $('#save-button').html("Save");
            $('#AddOrUpdateBookModal').modal('show'); 
      });

        $('#save-button').click(function (e) {
        e.preventDefault();
        var data = $('#AddOrUpdateBookForm');
        var form_data = new FormData(data[0]);
        form_data.append('image', $('#image').val());
        $.ajax({
        //   data: $('#Add-New-Book').serialize(),
          data: form_data,
          url: "{{ route('modal') }}",
          type: "POST",
          processData: false,
          contentType: false,
          success: function (data) {$('#AddOrUpdateBookForm').trigger("reset");
              $('#AddOrUpdateBookModal').modal('hide');
              $("#bookTable").dataTable().api().ajax.reload();
          },
          error: function (response) {
                    var response = JSON.parse(response.responseText);
                    console.log(response);
                    var errorString = '<ul>';
                    $.each( response.errors, function( key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul>';
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');
                    $('#save_msgList').html(errorString);
                }
      });
    });

    // edit
    $('body').on('click', '.editBook', function () {
        var book_id = $(this).attr('data-value');
        console.log(book_id);
        $.get('{{ route("editbook", "")}}'+"/"+book_id, function (data) {
          $('#modelHeading').html("Edit Book");
          $('#save-button').html("Edit");
          $('#book-id').val(book_id);
          $("#title").val(data.title);
          $(".img img").attr('src',data.image);
          $("#publisher_id").val(data.publisher_id);
          $("#author_id").val(data.books_author[0].author_id);
          $("#category_id").val(data.books_category[0].category_id);

          $("#published_year").val(data.published_year);
          $("#published_number").val(data.published_number);
          $("#description").val(data.description);
          $('#AddOrUpdateBookModal').modal('show');
          console.log('Edit');
    });
   });


    // delete
    $('body').on('click','.deletebtn',function(e){
        var id = $(this).attr('data-value');
        var url = "{{url('admin/book/delete')}}";
        console.log(id);
        Delete_button(url , id);
    });


});
  
</script>
@endpush
@stop