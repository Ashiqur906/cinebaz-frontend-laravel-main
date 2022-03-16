<template>

	<div ref="videoContainer" class="shadow-lg mx-auto max-w-full size">
		<!-- <a href="#" class=" navigationBtn">
		
		</a> -->
		<video
		id="video"
		ref="videoPlayer"
		class="w-full h-full"
		:poster="posterUrl"
		autoplay
		></video>
	</div>
</template>

<script>
	export default {
		props: {
			manifestUrl: {
				type: String,
				required: true
			},
			licenseServer: {
				type: String,
				required: true
			},
			posterUrl: {
				type: String,
				required: false,
				default: ''
			},
			startTime: {
				default: 0.00
			},
			saveUrl: {
				type: String,
				required: true,
				default: ''
			},
			mediaId: {
				type: String,
				required: true,
				default: ''
			},
		},
		
		mounted() {
			//key method
			window.addEventListener('keydown', (e) => {
				const videoContainer = document.querySelector('video');
				let is_fullscreen = () => !!document.fullscreenElement
				let audio_vol = video.volume;
				if (e.key == 'f') {
					if (is_fullscreen()) {
						document.exitFullscreen();
					} else {
						videoContainer.requestFullscreen();
					}
					e.preventDefault();
				}
				else if (e.key == ' ') {
					if (video.paused) {
						video.play();
					} else {
						video.pause();
					}
					e.preventDefault();
				}
				else if (e.key == "ArrowUp") {
					e.preventDefault();
					if (audio_vol != 1) {
						try {
							video.volume = audio_vol + 0.05;
						}
						catch (err) {
							video.volume = 1;
						}
					}
				}
				else if (e.key == "ArrowDown") {
					e.preventDefault();
					if (audio_vol != 0) {
						try {
							video.volume = audio_vol - 0.05;
							
						}
						catch (err) {
							video.volume = 0;
						}
					}
				}
				else if (e.key == "ArrowLeft") {
					e.preventDefault();
					if (video.currentTime != 0) {
						try {
							video.currentTime = video.currentTime - 5;
						}
						catch (err) {
							video.currentTime = 0;
						}
					}

				}
				else if (e.key == "ArrowRight") {
					e.preventDefault();
					if (video.currentTime != 0) {
						try {
							video.currentTime = video.currentTime + 5;
						}
						catch (err) {
							video.currentTime = 0;
						}
					}

				}

			});
			//pre code to load player
			const shaka = require('shaka-player/dist/shaka-player.ui.js');
			const player = new shaka.Player(this.$refs.videoPlayer);
			const ui = new shaka.ui.Overlay(
				player,
				this.$refs.videoContainer,
				this.$refs.videoPlayer
				);
			ui.getControls();

			console.log(Object.keys(shaka.ui));

			player.configure({
				drm: {
					servers: { 'com.widevine.alpha': this.licenseServer }
				}
			});

			player
			.load(this.manifestUrl)
			.then(() => {
				// This runs if the asynchronous load is successful.
				this.setCurTime();
				// console.log("Starts From:", this.startTime);
				this.getCurTime(this.saveUrl,this.mediaId);
				
			})
			.catch(this.onError); // onError is executed if the asynchronous load fails.

			
			
		},
		methods: {
			onError(error) {
				console.error('Error code', error.code, 'object', error);
			},
			getFile: function (file) {
				return this.$asset_url + "storage/" + file;
			},

		//ratan's code
		setCurTime() { 
			var startTime = this.startTime;
			video.currentTime = this.startTime;
			// console.log( this.startTime);
		},

		getCurTime(url,mediaId) {
			var intervalId = window.setInterval(function(){
				try{
					axios.post(url,{
						media_id: mediaId,
						last_time: video.currentTime
					});
				}
				catch(e){
					console.log(e)
				}
			}, 10000);
		},
		
	},
};
</script>

<style>
@import '../../../node_modules/shaka-player/dist/controls.css'; /* Shaka player CSS import */

.size{
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border: 0;
}
body{
	background: #000;
}
.navigationBtn {
	width: 50px;
	height: 50px;
	position: absolute;
	text-shadow: 0 0 rgb(192, 192, 192);
	margin-top: 2.5%;
	margin-left: 25px;
	transition-duration: 0.6s;
}
.shaka-spinner-svg {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	animation: rotate 2s linear infinite;
	transform-origin: center center;
	width: 100%;
	height: 100%;
	margin: 0;
	padding: 0;
}
.shaka-spinner-path {
	stroke: #ff1919;
}
.shaka-spinner {
	padding: 30px;
}
</style>
