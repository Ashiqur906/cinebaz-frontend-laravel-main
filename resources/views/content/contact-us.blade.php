@extends('layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ url('assets/frontend/contact/style.css') }}" />
@endpush
@section('content')
<section class="ftco-section" style="padding-top:150px">

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 text-center mb-5">
					<h2 class="heading-section">Contact Us</h2>
				</div>
			</div>
			<div class="row justify-content-left" style="padding-top:50px">
				<div class="col-lg-12 col-md-12">
					<div class="wrapper">
						<div class="row justify-content-left">
							<div class="col-lg-4 mb-5">
								<div class="row">
                                <h3 class="mb-4 text-center" style=" font-size:25px;color:#ffffff;padding-top:5px;padding-bottom:30px";>Corporate Office</h3>

									<div class="col-md-12">
										<div class="dbox w-100 text-center">
                                            <div class="row">
                                                <div class="icon d-flex align-items-center justify-content-center col-md-1">
                                                    <span class="fa fa-map-marker"></span>
                                                </div>
                                                <div class="text col-md-11 text-left">
                                                    <p><span>Address:</span> Address: 80/5 VIP Rd, Dhaka 1000</p>
                                                </div>
                                            </div>
					                    </div>
									</div>
                                   <div style="height:120px"></div>
									<div class="col-md-12">
										<div class="dbox w-100 text-center">
                                            <div class="row">
                                                <div class="icon d-flex align-items-center justify-content-center col-md-1">
                                                      <span class="fa fa-phone"></span>
                                                </div>
                                                <div class="text col-md-11 text-left">
                                                      <p><span>Phone:</span>+88 01958095007</p>
                                                </div>
                                            </div>
					                    </div>
									</div>
                                    <div style="height:120px"></div>
									<div class="col-md-12">
										<div class="dbox w-100 text-center">
                                            <div class="row">
                                                <div class="icon d-flex align-items-center justify-content-center col-md-1">
                                                    <span class="fa fa-paper-plane"></span>
                                                </div>
                                                <div class="text col-md-11 text-left">
                                                    <p><span>Email:</span>info@cinebaz.com</p>
                                                </div>
                                            </div>
					                    </div>
									</div>
								</div>
							</div>
                            <div class="col-lg-2"></div>
							<div class="col-lg-6">
								<div class="contact-wrap">
									<h3 class="mb-4 text-center" style=" font-size:25px">Get in touch with us</h3>
									<div id="form-message-warning" class="mb-4 w-100 text-center"></div>
                                    <div id="form-message-success" class="mb-4 w-100 text-center">
                                    Your message was sent, thank you!
                                    </div>
                                    @if(Session::has('status'))
                                        <div class="alert alert-success text-center">
                                            <p class="pt-3">Information sent successfully !<br/>
                                            We shall contact you as early as possible.</p>
                                        </div>
                                    @else
									<form method="POST" id="contactForm" action="{{route('frontend.send-contact-info')}}" class="contactForm">
                                        @csrf
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" name="first_name" id="first_name" value="{{@old('first_name')}}" placeholder="First Name *" required>
                                                    <font style="color:#e60000">{{($errors->has('first_name'))?($errors->first('first_name')):' '}}</font>
												</div>
											</div>
                                            <div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" name="last_name" id="last_name" value="{{@old('last_name')}}" placeholder="last Name *" required>
												    <font style="color:#e60000">{{($errors->has('last_name'))?($errors->first('last_name')):' '}}</font>
                                                </div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="email" class="form-control" name="email" id="email" value="{{@old('email')}}" placeholder="Email *" required>
                                                    <font style="color:#e60000">{{($errors->has('email'))?($errors->first('email')):' '}}</font>
                                                </div>
											</div>
                                            <div class="col-md-6">
												<div class="form-group">
													<input type="phone" class="form-control" name="phone" id="phone" value="{{@old('phone')}}" placeholder="phone *" required>
                                                    <font style="color:#e60000">{{($errors->has('phone'))?($errors->first('phone')):' '}}</font>
                                                </div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="subject" id="subject" value="{{@old('subject')}}" placeholder="Subject *" required>
												    <font style="color:#e60000">{{($errors->has('subject'))?($errors->first('subject')):' '}}</font>
                                                </div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<textarea name="message"  class="form-control" id="message" cols="30" rows="6" placeholder="Message *" required>{{@old('message')}}</textarea>
												    <font style="color:#e60000">{{($errors->has('message'))?($errors->first('message')):' '}}</font>
                                                </div>
											</div>
											<div class="col-md-4 offset-4">
												<div class="form-group">
													<input type="submit" value="Send Message" class="btn btn-primary">
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
                                    @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="col-md-12" style="padding-top:50px">
                <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14609.131739736918!2d90.4076468!3d23.7372879!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4be9e304803d052a!2sCinebaz%20Limited!5e0!3m2!1sen!2sbd!4v1631897501459!5m2!1sen!2sbd"
                        height="450" style="border:0; width:100%" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
		</div>
	</section>
@endsection
@push('scripts')

@endpush
