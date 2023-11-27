<!DOCTYPE html>


<html dir="{{ $dir }}" lang="{{ $locale }}" class="{{ $dir == 'rtl' ? 'fa-dir-flip' : '' }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="Admin, Control Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('general::lang.siteTitle') }} | {{ __('general::lang.adminPanel') }}</title>

    <link rel="icon" href="{{ asset('assets/adminPanel/img/logo-icon.png') }}" type="image/png" sizes="16x16">

    {{-- <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}"> --}}
    @if($dir == 'rtl')
        {{-- RTL Styles --}}
        {{-- <link rel="stylesheet" href="{{ asset('front/css/custom-rtl.css') }}"> --}}
    @endif
    <!-- Icons-->
    <link href="{{ asset('assets/adminPanel/vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/vendors/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />  --}}

    <!-- Styles for File Input Plugin-->
    <link href="{{ asset('assets/adminPanel/css/file-input/fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/css/file-input/fileinput-rtl.css') }}" rel="stylesheet">

    {{-- Alertify JS --}}
    @if($dir == 'rtl')
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.rtl.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.rtl.min.css"/>

    @else
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>
    @endif
    {{-- End / Alertify JS --}}

    {{-- for pusher  --}}
    <script src="{{ asset('assets/adminPanel/js/pusher.min.js') }}"></script>
    <script>
        /**
        * Plays a sound using the HTML5 audio tag. Provide mp3 and ogg files for best browser support.
        */
        function playSound(){

            var mp3Source = '<source src="{{ asset('sounds/inflicted-mp.mp3') }}" type="audio/mpeg">';
            var oggSource = '<source src="{{ asset('sounds/inflicted-og.ogg') }}" type="audio/ogg">';
            var embedSource = '<embed hidden="true" autostart="true" loop="false" src="{{ asset('sounds/inflicted-mp.mp3') }}">';
            document.getElementById("sound").innerHTML='<audio id="notificationSound" autoplay="autoplay" loop>' + mp3Source + oggSource + embedSource + '</audio>';

        }
    </script>
    <!-- Main styles for this application-->
    <link href="{{ asset('assets/adminPanel/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/css/tajawal-font.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminPanel/css/custom.css') }}" rel="stylesheet">

    <!-- Styles for bootstrap4-toggle-->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    @stack('css')
    @yield('style')

</head>
<body class="app header-fixed sidebar-hidden aside-menu-fixed">
    @include('general::layouts.includes.header')

    <div id="overlayer"></div>

    <div class="row">
        <div class="col">
            <div class="text-center">
                <div class="loader">
                  <span class="loader-inner"> </span>
                </div>
            </div>
        </div>
    </div>

    <div id="sound"></div>
    <div class="app-body">
        @include('general::layouts.includes.sidebar')
        @yield('main')
    </div>
    @include('general::layouts.includes.footer')
    @include('general::layouts.includes.generalModal')
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('assets/adminPanel/vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/vendors/pace-progress/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/vendors/@coreui/coreui/js/coreui.min.js') }}"></script>
     <!-- <script src="{{ asset('assets/adminPanel/vendors/ckeditor/ckeditor.js') }}"></script> -->
     <!-- <script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script> -->
    <script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
    <script src="{{ asset('assets/adminPanel/vendors/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/vendors/select2/js/i18n/ar.js') }}"></script>
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  --}}

    <!-- Custom scripts required by this view -->

    <!-- JS for File Input Plugin-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/adminPanel/js/file-input/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/js/file-input/themes/theme.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/js/file-input/ar.js') }}"></script>

    {{-- Alertify --}}

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/adminPanel/js/custom.js') }}"></script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (session()->has('status'))
            @if(!$agent->isPhone())
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('status') }}",
                })
            @else
                Swal.fire({
                    title: "{{__('lang.SuccessAlert')}}",
                    text: "{{ session('status') }}",
                    icon: 'success',
                    confirmButtonText: "{{__('general::lang.close')}}"
                })
            @endif
        @endif
        @if (session()->has('status_danger'))
            @if(!$agent->isPhone())
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('status_danger') }}",
                })
            @else
                Swal.fire({
                    title: "{{__('lang.warningAlert')}}",
                    text: "{{ session('status_danger') }}",
                    icon: 'error',
                    confirmButtonText: "{{__('general::lang.close')}}"
                })
            @endif

        @endif
        @if (session()->has('success_modal'))
            Swal.fire({
                title: "{{ session('success_modal') }}",
                // text: "{{ session('success_modal') }}",
                icon: 'success',
                confirmButtonText: "{{__('general::lang.close')}}"
            })
        @endif

        // $( function(){

        //   $('[type=date]').datepicker({
        //         dateFormat: "yy-mm-dd",
        //         changeMonth: true,
        //         changeYear: true,
        //         showButtonPanel: true,
        //         yearRange: "-50:+50",
        //     }).attr('readonly','readonly');
        // });
      // $(".loader").delay(2000).fadeOut("slow");
    //  $("#overlayer").delay(2000).fadeOut("slow");
    //  $(document).ready(function() {
    //     $(".loader").show();
    //     $("#overlayer").show();
    //   });
    //   $(".loader").hide();
    //   $("#overlayer").hide();
    $('.delete-form').click(function(e) {
        e.preventDefault() // Don't post the form, unless confirmed

        alertify.dialog('confirm')
        .set('title', '')
        .set('labels', {ok:"{{ __('general::lang.ok') }}", cancel:"{{ __('general::lang.cancel') }}"})
        .set({transition:'zoom',message: "{{ __('general::lang.AreYouSure') }}"})
        .set('onok', function(closeEvent){
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        })
        .set('oncancel', function(closeEvent){

        })
        .show();
    });

    </script>
    <script>
        function changeStatus(type,id){

            if(type == 'articles_featured'){
                type = 'articles';
                field = 'articles_featured';
                if(document.getElementById('articles_featured'+id).checked){
                    status = '1';
                }else{
                    status = '0';
                }
            }else{
                field = 'status';
                if(document.getElementById(type+'_status_'+id).checked){
                    status = '1';
                }else{
                    status = '0';
                }
            }
 
            $.ajax({
                type: "GET",
                url: "<?php echo url('/')?>/{{$locale}}/admin/"+type+"/changeStatus/"+id+"/"+status+"?field="+field,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'device_token': "{{ isset($device_token) ? $device_token : '' }}",
                },
                success: function(data) {
                    Swal.fire({
                        title: data.msg,
                        // text: data.msg,
                        icon: 'success',
                        confirmButtonText: "{{__('general::lang.close')}}"
                    })

                    if(type == 'offers_magazines'){
                        location.reload()
                    }
                }
            })

        }

        function changeStatusInput(type){
            if(document.getElementById(type+'_status').checked){
                $('#'+type+'_status_input').val('1')
            }else{
                $('#'+type+'_status_input').val('0')
            }
        }

        function changeToggleInput(type){
            if(document.getElementById(type).checked){
                $('#'+type+'_input').val('1')
            }else{
                $('#'+type+'_input').val('0')
            }
        }
    </script>
    <!-- JS for bootstrap4-toggle-->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


    {{-- @include('general::layouts.includes.notifications_script') --}}
    @include('general::layouts.includes.ckeditor')

    @stack('js')
    @yield('script')
    
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

</body>
</html>
