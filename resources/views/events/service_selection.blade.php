<div class="container">
    <!-- Services Section -->
    <h3>Select Services</h3>
    <div class="row">
        @foreach($services as $service)
        <div class="col-md-12 mb-3">
            <div class="card service-card" onclick="toggleCardSelection(this)" data-id="{{ $service->id }}" data-price="{{ $service->price }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $service->name }}</h5>
                    <p class="card-text">{{ $service->description }}</p>
                    <p class="card-text"><strong>Price:</strong> Rs.{{ $service->price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between button-container mb-4">
        <a href="{{ route('events.create') }}" class="btn btn-secondary button-style  ml-auto">Back</a>
        <form action="" method="POST">
            @csrf
            <input type="hidden" name="selected_services" id="selected_services">
            <input type="hidden" name="total_service_price" id="total_service_price">
            <button type="submit" class="btn btn-primary button-style">Next</button>
        </form>

    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        function toggleCardSelection(card) {
            $(card).toggleClass('selected');
        }

        function updateSelectedServices() {
            var selectedServices = [];
            var totalServicePrice = 0;

            $('.service-card.selected').each(function() {
                var serviceId = $(this).data('id');
                var servicePrice = parseFloat($(this).find('.card-text strong').text().replace('Rs.', ''));
                selectedServices.push(serviceId);
                totalServicePrice += servicePrice;
            });

            $('#selected_services').val(JSON.stringify(selectedServices));
            $('#total_service_price').val(totalServicePrice);
        }
    </script>
    @endsection