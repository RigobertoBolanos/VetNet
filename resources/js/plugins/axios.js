import axios from 'axios'
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
   'X-Requested-With': 'XMLHttpRequest'
};

axios.defaults.baseURL = "localhost:8000/api/"

export default axios;