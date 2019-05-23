import store from '../store';

export function login(credentials) {
    return new Promise((resolve, reject) => {
        axios.post('/api/user/login', credentials)
            .then(response => {
                resolve(response.data);
            })
            .catch(error => {
                reject(error);
            });
    });
}

export function register(credentials) {
    return new Promise((resolve, reject) => {
        axios.post('/api/user/registration', credentials)
            .then(response => {
                resolve(response.data);
            })
            .catch(error => {
                reject(error);
            });
    });
}

export function getLocalUser() {
    const user = localStorage.getItem('user');

    if(!user)  {
        return null;
    }

    return JSON.parse(user);
}

export function getLocalToken() {
    const token = localStorage.getItem('token');

    if(!token) {
        return null;
    }

    return JSON.parse(token);
}
