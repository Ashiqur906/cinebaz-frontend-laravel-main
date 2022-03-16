<template>
  <div class="container">
    <video-player
      :license-server="licenseServer"
      :manifest-url="vediourl"
      :poster-url="bannerurl"
      :start-time="start"
      :save-url="saveurl"
      :media-id="mediaid"
    />
  </div>
</template>

<script>


export default { 
    props: {
    vediourl: {
      type: String,
      required: true
    },
    bannerurl: {
      type: String,
      required: false,
      default: ''
    },
     start: {
      default: 0.00
    },
    saveurl: {
      type: String,
      required: true,
      default: ''
    },
    mediaid: {
      type: String,
      required: true,
      default: ''
    }
  },

  data() {
    return {
      licenseServer: 'https://widevine-proxy.appspot.com/proxy',
    };
  }
};
</script>
