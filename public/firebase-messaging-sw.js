
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js');

const firebaseConfig = {
  apiKey: "AIzaSyDsvdKuS_PBvmEcVlX3PkXIZmiW5yJsNYw",
  authDomain: "shapla-media.firebaseapp.com",
  databaseURL: "https://shapla-media.firebaseio.com",
  projectId: "shapla-media",
  storageBucket: "shapla-media.appspot.com",
  messagingSenderId: "379398615317",
  appId: "1:379398615317:web:20b5b4fad388c26648f91c",
  measurementId: "G-QCXRK1RY3J"
};
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  // Retrieve an instance of Firebase Messaging so that it can handle background
  // messages.
  const messaging = firebase.messaging();

  messaging.setBackgroundMessageHandler(function(payload){
    // console.log('[firebase-messaging-sw.js] Recieved Background message ', payload);
    var notificationTitle = 'Background Message Title';
    var notificationOptions = {
      body: 'Background Message Body.',
      icon: '/firebase-logo.png'
    };
  return self.ServiceWorkerRegistration.showNotification(notificationTitle,notificationOptions);
});


