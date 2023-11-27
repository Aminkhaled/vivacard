 
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
<footer class="app-footer">
  <div>
    {{date('Y')}}
    &copy;
    <a
      href="https://www.{{env('APP_NAME','test')}}.com/"
      target="_blank"
      rel="noopener noreferrer"
      className="mx-2"
    >
      <span style="font-size: 12px; letter-spacing: -1px" >
        {{ __('general::lang.siteTitle') }}
      </span>
      <img
        src={{ asset($locale == 'ar' ? 'assets/adminPanel/img/logo-ar.png' : 'assets/adminPanel/img/logo-en.png') }}
        alt="{{env('APP_NAME','test')}}"
        className="img-fluid mx-3 brand-img"
        style="width: 45px"
      />
    </a>

  </div>
</footer>
