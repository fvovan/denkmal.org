self.addEventListener('install', function(event) {
  // Automatically take over the previous worker.
  event.waitUntil(self.skipWaiting());
});

self.addEventListener('push', function(event) {
  console.debug('Service worker: push', event);

  var title = 'Yay a message.';
  var body = 'We have received a push message.';
  var icon = '/images/icon-192x192.png';
  var tag = 'simple-push-demo-notification-tag';

  event.waitUntil(
    self.registration.showNotification(title, {
      body: body,
      icon: icon,
      tag: tag
    })
  );
});
