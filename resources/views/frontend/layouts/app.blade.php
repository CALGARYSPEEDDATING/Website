<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Calgary Speed Dating is #1 company for speed dating in Calgary. We hold the Guinness World Records for the largest speed dating in event')">
        <meta name="author" content="@yield('meta_author', 'Calgary Speed Dating')">
        <meta name="keywords" content="calgary, calgary speed dating, singles, dating, speed dating, speed dating events">

        
        <!--OG TAGS-->
        <meta property="og:title" content="Calgary Speed Dating">
        <meta property="og:url" content="{{url('/') }}">
        <meta property="og:image" content="{{ URL::asset('frontend/images/logo/logo_house_sm.png')}}">
        <meta property="og:description" content="Calgary Speed Dating - Speed dating and fun events">
        <meta property="business:contact_data:locality" content="Calgary">
        <meta property="business:contact_data:region" content="Alberta">
        <meta property="business:contact_data:country_name" content="Canada">
        <!--Twitter TAGS-->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:image" content="{{ URL::asset('frontend/images/logo/logo_house_sm.png')}}">
        <meta name="twitter:site" content="@CgySpeedDating">
        <meta name="twitter:title" content="Calgary Speed Dating">
        <meta name="twitter:description" content="Calgary Speed Dating - Online payment processing for internet businesses">



	   <!--favicons-->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('frontend/images/favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('frontend/images/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="">
        <link rel="shortcut icon" href="{{ URL::asset('frontend/images/favicon/favicon.ico')}}">
        <meta name="msapplication-config" content="{{ URL::asset('frontend/images/favicon/favicons/browserconfig.xml')}}">
        {{-- <meta name="theme-color" content="#ffffff"> --}}

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127886100-1"></script>
        <script data-ad-client="ca-pub-1714533561667649" async src=https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-127886100-1');
        </script>

        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '305687186797335'); 
        fbq('track', 'PageView');
        </script>
        <noscript>
         <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=305687186797335&ev=PageView
        &noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{-- {{ style(mix('css/frontend.css')) }} --}}
        @include('frontend.includes.partials.styles')

        @stack('after-styles')
        <style>
        #site-load{
            width:100%;
            height:100%;
            position:fixed;
            z-index:9999;
            background:url("https://www.creditmutuel.fr/cmne/fr/banques/webservices/nswr/images/loading.gif") no-repeat center center rgba(0,0,0,0.25)
            }
</style>

<style type="text/css">
   .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }
        .loader {            
            margin: 60px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(255, 255, 255, 0.2);
            border-right: 1.1em solid rgba(255, 255, 255, 0.2);
            border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
            border-left: 1.1em solid #ffffff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        #loadingDiv {
            position:absolute;;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color:#000;
        }
</style>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "Calgary Speed Dating",
  "url": "https://calgaryspeeddating.com/",
  "description":"Calgary Speed Dating is the #1 company for speed dating in Calgary. 💏 Meet Calgary singles through speed dating. Register now. 80% Match Rate",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://calgaryspeeddating.com/{search_term_string}",
    "query-input": "required name=search_term_string"
  },
    "sameAs": [
    "https://www.facebook.com/RealCalgarySpeedDating/",
    "https://twitter.com/CgySpeedDating",
    "https://www.instagram.com/calgarydating/"
  ] 
}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-46DDDDT2Z2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-46DDDDT2Z2');
</script>
    </head>
    <body>
        <div id="app">
            <header>
                    {{-- <div id="site-load"></div> --}}
                   
                    
            </header>
                
                <div id="site-contents">
               
                @include('includes.partials.messages')
            @include('includes.partials.logged-in-as')
            @if (\Request::is('/'))  
                @include('frontend.includes.nav')
            @elseif (\Request::is('events'))
            @include('frontend.includes.event_nav')
            @elseif(\Request::is('policies') || \Request::is('how-it-works')  || \Request::is(['faq', 'password/reset*'])   
            || \Request::is('login') || \Request::is('testimonials') || \Request::is('register') || \Request::is('about') ) 
            @include('frontend.includes.no_fix_nav')   
            @else
                @include('frontend.includes.main_nav')
            @endif
            
            {{-- @include('frontend.includes.banner') --}}
            {{-- <div class="container">
                </div><!-- container --> --}}

                
                @yield('content')
                @include('frontend.includes.footer')
            </div>
        </div><!-- #app -->
           

    
        <!-- Scripts -->
        @stack('before-scripts')
        {{-- {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!} --}}
        @include('frontend.includes.partials.js')

        @stack('after-scripts')
         {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> --}}
        @include('sweet::alert')
        <script src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
        <script>
            const observer = lozad();
            observer.observe();
            // $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
            // $(window).on('load', function(){
            // setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
            // });
            // function removeLoader(){
            //   $( "#loadingDiv" ).fadeOut(500, function() {
            //     // fadeOut complete. Remove the loading div
            //     $( "#loadingDiv" ).remove(); //makes page more lightweight 
            // });  
            // }
            
              </script>
        @include('includes.partials.ga')
    </body>

    
</html>