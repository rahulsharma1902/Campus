@extends('Public.index')
@section('login-content')
    <section>
    <div class="container col-lg-8">
<div class="col-md-12">
            <div class="card card-dark mt-4">
              <div class="card-header">
                <h3 class="card-title ">REQUEST TO UNABLE YOUR ACCOUNT</h3>
              </div>
              <div class="card-body">
                <form action="{{url('/requnableaccount')}}" method="get">
                    @csrf
    
                        <div class="form-group">
                        <input type="hidden" name="username" value="{{Request::segment(2)}}">
                    </div>
                        <div class="form-group">
                            <label for="reason">Why ? Account Disabled</label>
                             <textarea name="reason" id="reason" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LdcyKgkAAAAAD9dDh2p7bDIVc1V2zGZtsd2KIex"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>  
                                </div>
                      
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">Send Request</button>
                        </div>
                </form>
              </div>
            </div>
</div></div>
    </section>
@endsection