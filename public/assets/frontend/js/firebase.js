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
const messaging = firebase.messaging();
messaging
    .requestPermission()
    .then(function(){
        console.log('Notification permission granted.');
        return messaging.getToken()
    }).then(function(token){
        console.log(token);
    }).catch(function(err){
        console.log("Unable to get Permission to notify", err);
    })
messaging.onMessage((payload)=>{
    console.log(payload);
})


