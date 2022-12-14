window._ = require('lodash');

/**
 * Bootstrap
 */
// try {
//     require('bootstrap');
// } catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Jquery
 */
// try {
//     window.$ = require('jquery');
//     // window.$ = window.jQuery = require('jquery');
//     require('select2');
// } catch (error) {
//     console.log(error);
// }

// Bootstrap and Jquery
try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('@popperjs/core');
    window.bootstrap = require('bootstrap');
    window.select2 = require('select2');
} catch (exception) {
    console.error(exception);
}
// Awal Alert 2
window.Swal = require('sweetalert2');


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
