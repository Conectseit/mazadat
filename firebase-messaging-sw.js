importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

// For Firebase JS SDK v7.20.0 and later, measurementId is optional
firebase.initializeApp({
    apiKey: "AIzaSyBFbtTK5VtTf6IlkBNefUsKgOe_kSJyicE",
    authDomain: "mzadat-3d599.firebaseapp.com",
    projectId: "mzadat-3d599",
    storageBucket: "mzadat-3d599.appspot.com",
    messagingSenderId: "291352482082",
    appId: "1:291352482082:web:0a3903fa1e9464e27c557b",
    measurementId: "G-GR7JYH9JGH"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = payload.data.title;
    const notificationOptions = {
        body: payload.data.title,
        icon: payload.data.icon //your logo here
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
