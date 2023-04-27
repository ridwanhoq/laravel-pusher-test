var channel = pusher.subscribe('your-channel-name');
channel.bind('YourEventName', function(data) {
  // Handle the event data
});

------------------------------------

>> laravel project 
>> npm install --save laravel-echo pusher-js
>> composer require pusher/pusher-php-server
>> php artisan optimize
>> set BROADCAST_DRIVER to pusher
>> check config/broadcasting.php 
    >>  'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                // 'useTLS' => true,
                'encrypted' => true,
            ],
        ],
>> check resource/js 
    >> import Echo from 'laravel-echo';

        window.Pusher = require('pusher-js');

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '04f878756a5450639f88',
            cluster: 'ap2',
            encrypted: true
        })
>> check web.php 
    
        Route::get('chat', function(){
            return view('user.index');
        });

        Route::post('sendMessage', function (Request $request) {
            
            event(
                new MessageEvent(
                    $request->userName,
                    $request->userMessage
                )
            );
            return $request;
        })->name('send-message');

>> now make a view and submit the form with username and message

-------

>> to listen the event

>>  window.Echo.channel('message-channel')
            .listen('new-message', (e) => {
                console.log(e)
                this.message = e.message
            })