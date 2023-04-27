@extends('layouts.app')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            Chat with your friend
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="text-success text-left">
                                <strong>You : </strong> Username 1
                                <p>
                                    your message
                                </p>
                            </div>
                            <div class="text-info pull-right">
                                <strong>Friend : </strong> Username 2
                                <p>
                                    friend's message
                                </p>
                            </div>

                            {!! Form::open() !!}

                            {!! Form::hidden('user_name', 'test_user', ['id' => 'userName']) !!}

                            {!! Form::label('message', 'Message') !!}

                            {!! Form::textarea('message', null, ['class' => 'form-control', 'id' => 'userMessage']) !!}

                            {!! Form::button('Send', ['class' => 'btn btn-sm btn-success mt-2', 'id' => 'sendButton']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {


            $('#sendButton').on('click', function() {

                let userName = $('#userName').val();
                let userMessage = $('#userMessage').val();

                console.log(userName + userMessage);

                if (userName == '' || userMessage == '') {
                    alert('Username and message fields are required');
                    return false;
                }

                $.ajax({
                    url: "{{ route('send-message') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: {
                        'userName': userName,
                        'userMessage': userMessage
                    },
                    success: function(res) {
                        console.log(res);
                    }
                });
            });



        });


        window.Echo.channel('my-channel')
            .listen('userMessage', (e) => {
                console.log(e)
                this.message = e.message
            });
    </script>
@endsection
