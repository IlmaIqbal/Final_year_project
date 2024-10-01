@extends('admin.navbar')

@section('title')
Calendar
@endsection
@section('content')



<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Event title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="title">
                <span id="titleError" class=" text-danger">
                </span>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" col-md-11 offset-1 mt-5 mb-5">
                <div id="calendar">

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {



        var booking = @json($bookings);

        $("#calendar").fullCalendar({
            header: {
                left: "prev, next today",
                center: "title",
                right: "month, agendaWeek, agendaDay",
            },
            events: booking,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDays) {
                // $('#eventModal').modal('toggle');

                // $('#btnSave').click(function() {
                //     var title = $('#title').val();
                //     var start_date = moment(start).format('YYYY-MM-DD');
                //     var end_date = moment(end).format('YYYY-MM-DD');

                //     $.ajax({
                //         url: "{{ route('calendar.store') }}",
                //         type: "POST",
                //         dataType: 'json',
                //         data: {
                //             title,
                //             start_date,
                //             end_date
                //         },
                //         success: function(response) {
                //             $("#eventModal").modal('hide')
                //             $('#calendar').fullCalendar('renderEvent', {
                //                 'title': response.title,
                //                 'start': response.start,
                //                 'end': response.end,
                //             })
                //         },
                //         error: function(error) {
                //             if (error.responseJSON.errors) {
                //                 $('#titleError').html(error.responseJSON.errors.title);
                //             }
                //         },
                //     });
                // });
            }
        });
    });
</script>

@endsection