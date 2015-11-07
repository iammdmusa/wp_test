jQuery(document).ready(function($) {
    jQuery('.gform_footer .gform_button').addClass('btn waves-effect waves-light');

    $('#input_2_18').keyup(function() {
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(characterReg.test(inputVal)) {
            alert("Please Put Address Like #House-941(D2),Road#-14,Dhaka-1207");
        }
    });
    var wow = new WOW(
        {
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset:       0,          // distance to the element when triggering the animation (default is 0)
            mobile:       true,       // trigger animations on mobile devices (default is true)
            live:         true,       // act on asynchronously loaded content (default is true)
            callback:     function(box) {
                // the callback is fired every time an animation is started
                // the argument that is passed in is the DOM node being animated
            },
            scrollContainer: null // optional scroll container selector, otherwise use window
        }
    );
    wow.init()

}(jQuery));