<script type='text/javascript' src='{{secure_asset('js/bootstrap.min7433.js')}}'></script>
<script type='text/javascript' src='{{secure_asset('js/homey-ajax6f3e.js')}}'></script>
<script type='text/javascript' src='{{secure_asset('js/custom6f3e.js')}}'></script>
<script type='text/javascript' src='{{secure_asset('js/skrollr.min5b21.js')}}'></script>
<script>
    $('#navbtn').click(function(){
        let attrBute  = $(this).attr('aria-expanded');
        console.log(attrBute);
        if(attrBute === "false"){
            $('#mobile-nav').slideDown("slow");
            $('#navbtn').attr('aria-expanded', "true");
        } else {
            $('#mobile-nav').slideUp("slow");
            $('#navbtn').attr('aria-expanded', "false");
        }

    });
    $('#profBtn').click(function(){
        let attrBute  = $(this).attr('aria-expanded');
        console.log(attrBute);
        if(attrBute === "false"){
            $('#user-nav').slideDown("slow");
            $('#profBtn').attr('aria-expanded', "true");
        } else {
            $('#user-nav').slideUp("slow");
            $('#profBtn').attr('aria-expanded', "false");
        }

    });
</script>
<!--[if lte IE 9]>
<script type='text/javascript' src='https://demo01.gethomey.io/wp-content/plugins/mailchimp-for-wp/assets/js/third-party/placeholders.min.js?ver=4.5.2'></script>
