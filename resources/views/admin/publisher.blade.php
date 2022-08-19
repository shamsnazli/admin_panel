@extends('layouts.main')

@section('MainContent')
<div class="card">
    <div class="card-header">
        <h4>{{$title}} </h4>
    </div>
        <div class="card-body">   
        <a href="#" class="btn btn-success" id="AddPublisher" >Add New Publisher</a>
            {!! $dataTable->table([
                'class'=>'dataTable table table-striped table-hover table-bordered' ,
                'id'=>'datatable'
            ]) !!}

        <div>
            
        </div>
        </div>
        
    
</div>

@push('js')
    {!! $dataTable->scripts() !!}
<script>
    $(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
            });
        $('#AddPublisher').on('click', function(){
            $('#modelHeading').html("Add New Publisher");
            $('#save-button').html("Save");
            $('#AddOrUpdateModal').modal('show'); 
      });
      $('#save-button').click(function (e) {
        e.preventDefault();
        var data = $('#AddOrUpdateForm');
        var form_data = new FormData(data[0]);
        $.ajax({
        //   data: $('#Add-New-Book').serialize(),
          data: form_data,
          url: "{{ route('AddOrUpdatePublisher') }}",
          type: "POST",
          processData: false,
          contentType: false,
          success: function (data) {$('#AddOrUpdateForm').trigger("reset");
              $('#AddOrUpdateModal').modal('hide');
              $("#datatable").dataTable().api().ajax.reload();
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
    $('body').on('click', '.editPublisher', function () {
        var publisher_id = $(this).attr('data-value');
        console.log(publisher_id);
        $.get('{{ route("editPublisher", "")}}'+"/"+publisher_id, function (data) {
          $('#modelHeading').html("Edit Publisher");
          $('#save-button').html("Edit");
          $('#id').val(publisher_id);
          $('#name').val(data.name);
          $('#AddOrUpdateModal').modal('show');
          console.log('Edit');
    });
   });


    // delete
    $('body').on('click','.deletebtn',function(e){
        var id = $(this).attr('data-value');
        var url = "{{url('admin/author/delete/')}}";
        console.log(id);
        Delete_button(url , id);
    });


});
</script>



@endpush
@stop
