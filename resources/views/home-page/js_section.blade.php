 <!-- jQery -->
 <script src="home-files/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="home-files/js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="home-files/js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="home-files/js/custom.js"></script>
 <!-- alpine js -->
 <script src="//unpkg.com/alpinejs" defer></script>

 {{-- <script src="jquery-3.6.1.min.js"></script> --}}

 {{-- script nga view_products --}}
 <script>
    function test() {
        d = document.getElementById("myselect").value;
        window.location.href = window.location.origin + window.location.pathname + '?order-by=' + d;
    }
 </script>

 {{-- stipe js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
<script type="text/javascript">
  
$(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>


{{-- script nga view_contact --}}
<script>
    function myFunction(){
        if(document.getElementById('radioselect').checked==true){
            document.getElementById('radioselect').value= document.getElementById('subselect').value;
        }
        else if(document.getElementById('radiowrite').checked==true){
            document.getElementById('radiowrite').value = document.getElementById('subwrite').value 
        }
    }
</script>

{{-- script nga products_details per comment_section--}}
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script type="text/javascript">
   function reply(caller){
      var commentId = $(caller).attr('data-commentId');
      var replyBox = document.getElementById('comment_id');
      replyBox.value=commentId;
      $('.replyClass').insertAfter($(caller));
      $('.replyClass').show();
   }

   function close_reply(caller){
      $('.replyClass').hide();
   }
</script>