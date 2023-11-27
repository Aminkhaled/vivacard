
   {{-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> --}}

<script>
    // Handle Notifications
    var notificationsWrapper   = $('.dropdown-notifications');
    // var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsWrapper.find('.notif-count');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('div.dropdown-menu');

    if (notificationsCount <= 0) {
    // notificationsWrapper.hide();
    }
    // console.log('channel')
    @can('view orders')
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        encrypted: true
        });
        var state = pusher.connection.state;
        console.log(state)
        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('new-order');
        // Bind a function to a Event (the full Laravel class)
        channel.bind('new-order', function(data) {
            //  console.log(data)
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var orderUrl = "{{ route('admin.orders.edit', ':id') }}";
                orderUrl = orderUrl.replace(':id', data.orders_id);
            var newNotificationHtml = `
                <a class="dropdown-item"
                    href="`+orderUrl+`" id="order-dropdown-item-`+data.orders_id+`">
                    `+data.message+`
                </a>
            `;
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
            playSound();

        });

        // Subscribe to the channel we specified in our Laravel Event read order
        var changeOrderChannel = pusher.subscribe('change-order-status');
        // Bind a function to a Event (the full Laravel class)
        changeOrderChannel.bind('change-order-status', function(data) {
            playSound();
             console.log(data)

        });


        var offerChannel = pusher.subscribe('new-offer');
        // Bind a function to a Event (the full Laravel class)
        offerChannel.bind('new-offer', function(data) {
            playSound();
             console.log(data)

        });

        var changeOfferChannel = pusher.subscribe('change-offer-status');
        // Bind a function to a Event (the full Laravel class)
        changeOfferChannel.bind('change-offer-status', function(data) {
            playSound();
             console.log(data)

        });


    @endcan
    // playSound();
    function stopSound() {
        console.log('read order') ;
        $('#notificationSound').attr('loop', false);
        // window.location = "{{ route('admin.orders.index') }}" ;
    }
</script>
 
    <script type="module">

  // Import the functions you need from the SDKs you need

  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";

  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-analytics.js";

  // TODO: Add SDKs for Firebase products that you want to use

  // https://firebase.google.com/docs/web/setup#available-libraries


  // Your web app's Firebase configuration

  // For Firebase JS SDK v7.20.0 and later, measurementId is optional

  const firebaseConfig = {

    apiKey: "AIzaSyBFpoTOuWfVhI-LBsY2kUR1Riwbeevtey0",

    authDomain: "laravel-771ca.firebaseapp.com",

    projectId: "laravel-771ca",

    storageBucket: "laravel-771ca.appspot.com",

    messagingSenderId: "365765340993",

    appId: "1:365765340993:web:a1c727b75beafac747bbc0",

    measurementId: "G-8VYDTS8G8S"

  };


  // Initialize Firebase

  const app = initializeApp(firebaseConfig);

  const analytics = getAnalytics(app);


importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyBFpoTOuWfVhI-LBsY2kUR1Riwbeevtey0",
      projectId: "laravel-771ca",
      messagingSenderId: "365765340993",
    appId: "1:365765340993:web:a1c727b75beafac747bbc0",
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
</script>
