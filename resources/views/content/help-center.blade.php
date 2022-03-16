@extends('layouts.master')
@section('content')
<section class="single-page">
	<div class="container container-sp">
		<div>
			<h2><strong>Help Center</strong></h2>
			<div class="row">
				<div class="col-md-6">
					<h3>Head Office</h3>
					<p>80/5 VIP Rd, Dhaka 1000, Bangladesh</p>
					<p>+8801958095007</p>
					<p>info@cinebaz.com</p>
					<div>
						<h3>Live Chat</h3>
						<button class="live-chat" >Start Live Chat</button>
					</div>
				</div>
				<div class="col-md-6">

					<!--Start of Tawk.to Script-->
					<script type="text/javascript">
						var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
						(function(){
							var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
							s1.async=true;
							s1.src='https://embed.tawk.to/6147177bd326717cb6823c12/1ffur7fgb';
							s1.charset='UTF-8';
							s1.setAttribute('crossorigin','*');
							s0.parentNode.insertBefore(s1,s0);
						})();
					</script>
					<!--End of Tawk.to Script-->
					<!--<iframe
					src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14609.131739736918!2d90.4076468!3d23.7372879!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4be9e304803d052a!2sCinebaz%20Limited!5e0!3m2!1sen!2sbd!4v1631897501459!5m2!1sen!2sbd"
					height="450" style="border:0; width:100%" allowfullscreen="" loading="lazy"></iframe> -->
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection
@push('scripts')

@endpush
@push('headcss')
    <style>
    .tawk-card .tawk-card-inverse .tawk-card-xsmall .tawk-footer .tawk-flex-none {
    	display: none !important;
		
	} 
    </style>
@endpush