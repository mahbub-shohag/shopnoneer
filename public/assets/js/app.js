import './bootstrap';
// resources/js/app.js

import axios from 'axios';

// Set default base URL for all Axios requests
axios.defaults.baseURL = 'https://your-api-domain.com/api';

// Set the Authorization header for all Axios requests (replace `yourToken` with the actual token)
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('yourToken')}`;

// You can also set other default settings, like Content-Type or Accept headers, if needed:
// axios.defaults.headers.common['Accept'] = 'application/json';
