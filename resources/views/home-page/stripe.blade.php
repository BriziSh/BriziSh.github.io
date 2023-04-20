<!DOCTYPE html>
<html>
<head>
    <title>Cart Payment</title>
    @include('home-page.css_section')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    
<div class="container center-align">
    
    <h1>Pay Using Your Cart - Total Amount ${{$total}}</h1>
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                        <h3 class="panel-title" >Payment Details</h3>
                </div>
                <div class="panel-body">

                    {{-- fshije me shh shance --}}
    
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center" x-data="{open:true}" x-init="setTimeout(()=>open=false,6000)" x-show="open">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    @if (Session::has('danger'))
                        <div class="alert alert-danger text-center" x-data="{open:true}" x-init="setTimeout(()=>open=false,6000)" x-show="open">
                            <p>{{ Session::get('danger') }}</p>
                        </div>
                    @endif
    
                    <form 
                            role="form" 
                            action="{{route('stripe')}}"
                            {{-- action="stripe" --}}
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
    
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        {{-- <input type="hidden" name="total" value="{{$total}}"> --}}
                        <input type="hidden" name="address" value="{{$address}}">
    
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{$total}})</button>
                            </div>
                        </div>
                            
                    </form>
                    <br>
                    
                    <a href="http://localhost/e-commerce/public/" >&lt;&lt;&lt; Go to Home Page</a>

                </div>
            </div>        
        </div>
    </div>
        
</div>
    @include('home-page.js_section')
</body>
    

</html>