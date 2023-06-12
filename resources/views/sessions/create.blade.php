@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a new Session</h2>
        <form method="POST" action="{{ route('sessions.store') }}" class="session-form">
            @csrf
            <div class="form-group">
                <label for="item_id">Item</label>
                <select name="item_id" id="item_id" required class="form-control">
                    <option value="">--Select Item--</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price_id">Price</label>
                <select name="price_id" id="price_id" required class="form-control">
                    <option value="">--First select an item--</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Start Session</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#item_id').change(function(){
                var itemId = $(this).val();

                $.ajax({
                    url: '/prices/item/' + itemId,
                    type: 'GET',
                    success: function(response) {
                        $('#price_id').empty();
                        console.log(response);
                        $.each(response, function(key, value) {
                            console.log(value.id);
                            $('#price_id').append('<option value="'+value.id+'">'+value.name+' (Start Price '+value.start_price+'$) | '+value.price+'/H</option>');
                        });
                    }
                });
            });
        });
    </script>

    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding-top: 50px;
        }

        .session-form .form-group {
            margin-bottom: 15px;
        }

        .session-form label {
            display: block;
            margin-bottom: 5px;
        }

        .session-form .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .session-form .btn {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
@endsection
