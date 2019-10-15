@extends('template.interface')
@section('content')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="wpb_text_column wpb_content_element " >
                </div>
                <div role="form" class="wpcf7" id="wpcf7-f1343-p1340-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <form action="{{URL('/contact')}}" method="post" class="wpcf7-form" novalidate="novalidate">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label class="required" for="yourName">Your Name</label>
                            <span class="wpcf7-form-control-wrap your-name">
                                <input type="text" name="name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" />
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="yourEmail">Your Email</label>
                            <span class="wpcf7-form-control-wrap your-email">
                                <input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control" aria-required="true" aria-invalid="false" />
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="yourSubject">Subject </label>
                            <span class="wpcf7-form-control-wrap your-subject">
                                @if($pre == null)
                                    <input type="text" name="subject" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" />
                                @else
                                    <input type="text" name="subject" value="{{$pre->noOfPlots.' plots, ' . $pre->name. ", ". $pre->address . ", ". $pre->state}}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" />
                                @endif
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="yourMessage">Your Concerns </label>
                            <span class="wpcf7-form-control-wrap your-message">
                                <textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false"></textarea>
                            </span>
                        </div>
                        <p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit btn btn-primary btn-invest-red" /></p>
                    </form>
                </div>
            </div>
        </div>
@stop
