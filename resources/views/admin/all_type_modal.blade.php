<!--  Modal -->
<div class="modal fade" id="AddOrUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modelHeading"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <ul id="save_msgList"></ul>
            <form class="signin-form" enctype="multipart/form-data" id="AddOrUpdateForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="id" value="">


                <div class="form-group form-input">
                    <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter name*">
                </div>

                <div class="modal-footer">
                    <button type="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-button">Save changes</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>


