<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110587568-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110587568-1');
</script>-->
<!-- Global site tag (gtag.js) - Google Ads: 875589977 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-875589977"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-875589977');
</script>

<!-- Event snippet for Окрашивание Волос conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
<script>
    function gtag_report_conversion(url) {
        var callback = function () {
            if (typeof(url) != 'undefined') {
                window.location = url;
            }
        };
        gtag('event', 'conversion', {
            'send_to': 'AW-875589977/QIJICKy_xokBENniwaED',
            'event_callback': callback
        });
        return false;
    }
</script>