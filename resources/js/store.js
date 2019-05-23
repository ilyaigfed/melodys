import {getLocalToken, getLocalUser} from './helpers/auth';
import axios from 'axios';
import {router} from './app';
import {Howl, Howler} from 'howler';

export default {
    state: {
        user: getLocalUser(),
        token: getLocalToken(),
        token_has_expired: null,
        navDrawer: true,
        profile: null,
        edit_profile_is_showed: false,
        edit_profile_loading: false,
        files: null,
        file_upload_progress: 0,
        available_duration: null,
        make_playlist: true,
        genres: null,
        playlist_types: null,
        profile_tracks: null,
        profile_albums: null,
        profile_playlists: null,
        profile_photos: null,
        profile_last_uploaded_tracks: null,
        profile_posts: null,
        interaction_profile: null,
        profile_followers: null,
        profile_followings: null,
        settings: null,
        track: null,
        album: null,
        playlist: null,
        track_comments: null
    },
    getters: {
        USER: state => {
            return state.user;
        },
        NAV_DRAWER: state => {
            return state.navDrawer;
        },
        PROFILE: state => {
            return state.profile;
        },
        EDIT_PROFILE_IS_SHOWED: state => {
            return state.edit_profile_is_showed;
        },
        TOKEN: state => {
            return state.token;
        },
        TOKEN_HAS_EXPIRED: state => {
            return state.token_has_expired;
        },
        EDIT_PROFILE_LOADING: state => {
            return state.edit_profile_loading;
        },
        FILES: state => {
            return state.files;
        },
        FILE_UPLOAD_PROGRESS: state => {
            return state.file_upload_progress;
        },
        AVAILABLE_DURATION: state => {
            return state.available_duration;
        },
        MAKE_PLAYLIST: state => {
            return state.make_playlist;
        },
        GENRES: state => {
            return state.genres;
        },
        PLAYLIST_TYPES: state => {
            return state.playlist_types;
        },
        PROFILE_TRACKS: state => {
            return state.profile_tracks;
        },
        PROFILE_ALBUMS: state => {
            return state.profile_albums;
        },
        PROFILE_PLAYLISTS: state => {
            return state.profile_playlists;
        },
        PROFILE_PHOTOS: state => {
            return state.profile_photos;
        },
        PROFILE_LAST_UPLOADED_TRACKS: state => {
            return state.profile_last_uploaded_tracks;
        },
        PROFILE_POSTS: state => {
            return state.profile_posts;
        },
        INTERACTION_PROFILE: state => {
            return state.interaction_profile;
        },
        PROFILE_FOLLOWERS: state => {
            return state.profile_followers;
        },
        PROFILE_FOLLOWINGS: state => {
            return state.profile_followings;
        },
        SETTINGS: state => {
            return state.settings;
        },
        TRACK: state => {
            return state.track;
        },
        ALBUM: state => {
            return state.album;
        },
        PLAYLIST: state => {
            return state.playlist;
        },
        TRACK_COMMENTS: state => {
            return state.track_comments;
        }
    },
    mutations: {
        SET_USER: (state, payload) => {
            state.user = payload;
        },
        SET_NAV_DRAWER: (state, payload) => {
            state.navDrawer = payload;
        },
        SET_PROFILE: (state, payload) => {
            state.profile = payload;
        },
        SET_EDIT_PROFILE_IS_SHOWED: (state, payload) => {
            state.edit_profile_is_showed = payload;
        },
        SET_TOKEN: (state, payload) => {
            state.token = payload;
        },
        SET_TOKEN_HAS_EXPIRED: (state, payload) => {
            state.token_has_expired = payload;
        },
        SET_EDIT_PROFILE_LOADING: (state, payload) => {
            state.edit_profile_loading = payload;
        },
        SET_FILES: (state, payload) => {
            state.files = payload;
        },
        SET_FILE_PROP: (state, payload) => {
            state.files[payload.key][payload.prop] = payload.data;
        },
        DELETE_FILE: (state, payload) => {
            if(state.files.length === 1) {
                state.files = null;
            } else {
                state.files.splice(payload, 1);
            }
        },
        SET_FILE_UPLOAD_PROGRESS: (state, payload) => {
            state.file_upload_progress = payload;
        },
        SET_AVAILABLE_DURATION: (state, payload) => {
            state.available_duration = payload;
        },
        SET_MAKE_PLAYLIST: (state, payload) => {
            state.make_playlist = payload;
        },
        SET_GENRES: (state, payload) => {
            state.genres = payload;
        },
        SET_PLAYLIST_TYPES: (state, payload) => {
            state.playlist_types = payload;
        },
        SET_PROFILE_TRACKS: (state, payload) => {
            state.profile_tracks = payload;
        },
        SET_PROFILE_ALBUMS: (state, payload) => {
            state.profile_albums = payload;
        },
        SET_PROFILE_PLAYLISTS: (state, payload) => {
            state.profile_playlists = payload;
        },
        SET_PROFILE_PHOTOS: (state, payload) => {
            state.profile_photos = payload;
        },
        SET_PROFILE_LAST_UPLOADED_TRACKS: (state, payload) => {
            state.profile_last_uploaded_tracks = payload;
        },
        SET_PROFILE_POSTS: (state, payload) => {
            state.profile_posts = payload;
        },
        SET_INTERACTION_PROFILE: (state, payload) => {
            state.interaction_profile = payload;
        },
        SET_PROFILE_FOLLOWERS: (state, payload) => {
            state.profile_followers = payload;
        },
        SET_PROFILE_FOLLOWINGS: (state, payload) => {
            state.profile_followings = payload;
        },
        SET_SETTINGS: (state, payload) => {
            state.settings = payload;
        },
        SET_TRACK: (state, payload) => {
            state.track = payload;
        },
        SET_ALBUM: (state, payload) => {
            state.album = payload;
        },
        SET_PLAYLIST: (state, payload) => {
            state.playlist = payload;
        },
        SET_TRACK_COMMENTS: (state, payload) => {
            state.track_comments = payload;
        }
    },
    actions: {
        LOGIN: (context, payload) => {
            const token = {
                access_token: payload.access_token,
                token_type: payload.token_type,
                expires_in: payload.expires_in * 1000,
                received_at: Date.now()
            };

            context.commit('SET_USER', payload.user);
            localStorage.setItem('user', JSON.stringify(context.getters.USER));
            context.commit('SET_TOKEN', token);
            localStorage.setItem('token', JSON.stringify(token));
            axios.defaults.headers.common['Authorization'] = 'Bearer '+token.access_token;
        },
        LOGOUT: async (context) => {
            try {
                const response = await axios.get('/api/user/logout');

                if(response.status === 200) {
                    context.commit('SET_USER', null);
                    localStorage.removeItem('user');
                    context.commit('SET_TOKEN', null);
                    localStorage.removeItem('token');
                    delete axios.defaults.headers.common['Authorization'];
                    router.push({ name: 'home' });
                }
            } catch (error) {
                throw new Error('Что-то пошло не так при выходе из аккаунта ('+error.response.status+')');
            }
        },
        CHECK_THE_TOKEN: async (context) => {
            const t = context.getters.TOKEN;

            if(!t || Date.now() - t.expires_in < t.received_at) {
                return true;
            }

            try {
                const response = await axios.get('/api/user/refresh');

                if(response.status === 200) {
                    const token = {
                        access_token: response.data.access_token,
                        token_type: response.data.token_type,
                        expires_in: response.data.expires_in * 1000,
                        received_at: Date.now()
                    };
                    context.commit('SET_TOKEN', token);
                    localStorage.setItem('token', JSON.stringify(context.getters.TOKEN));

                    axios.defaults.headers.common['Authorization'] = 'Bearer '+context.getters.TOKEN.access_token;
                }

            } catch (error) {
                if(error.response.status === 406) {
                    context.commit('SET_TOKEN_HAS_EXPIRED', true);
                    context.commit('SET_USER', null);
                    localStorage.removeItem('user');
                    context.commit('SET_TOKEN', null);
                    localStorage.removeItem('token');

                    throw new Error('Истек срок действия токена. Будет произведен выход из аккаунта.');
                }
            }
        },
        CHANGE_NAV_DRAWER: context => {
            context.commit('SET_NAV_DRAWER', !context.getters.NAV_DRAWER);
        },
        GET_PROFILE: (context, payload) => {
            context.dispatch('CHECK_THE_TOKEN');

            if(context.getters.TOKEN_HAS_EXPIRED) {
                context.commit('SET_TOKEN_HAS_EXPIRED', false);
                return true;
            }

            axios.get(`/api/user/${payload}/profile`).then(res => {
                context.commit('SET_PROFILE', res.data);
            }).catch(err => {
                if(err.response.status === 404) {
                    router.push({name: 'not-found'});
                }
                throw new Error('Что-то пошло не так при попытке получить данные о профиле ('+err.response.status+')');
            });
        },
        EDIT_PROFILE: (context, payload) => {
            context.commit('SET_EDIT_PROFILE_LOADING', true);
            payload.set('_method', 'put');
            axios.post(`/api/user/me/profile`, payload).then(res => {
                context.commit('SET_PROFILE', res.data);
                context.dispatch('UPDATE_USER');
                context.commit('SET_EDIT_PROFILE_IS_SHOWED', false);
                context.commit('SET_EDIT_PROFILE_LOADING', false);

            }).catch(err => {
                context.commit('SET_EDIT_PROFILE_LOADING', false);
            });
        },
        CHANGE_EDIT_PROFILE_IS_SHOWED: (context, payload) => {
            context.commit('SET_EDIT_PROFILE_IS_SHOWED', payload);
        },
        UPDATE_USER: (context) => {
            axios.get(`/api/user/me/profile`).then(res => {
                context.commit('SET_USER', Object.assign(
                    {}, res.data, {access_token: context.getters.USER.token}
                    )
                );
                localStorage.setItem('user', JSON.stringify(context.getters.USER));
            }).catch(err => {

            });
        },
        FOLLOW: (context, payload) => {
            axios.post(`/api/user/${payload}/following`).then(res => {
                context.state.profile.followers_count += 1;
                context.state.profile.is_following = true;
            });
        },
        UNFOLLOW: (context, payload) => {
            axios.delete(`/api/user/${payload}/following`).then(res => {
                context.state.profile.followers_count -= 1;
                context.state.profile.is_following = false;
            });
        },
        ADD_FILES: (context, payload) => {
            const files = Array.prototype.slice.call(payload),
                existing_files = context.getters.FILES;

            let _files = [];

            for(let i = 0; i < files.length; i++) {
                _files[i] = {
                    title: null,
                    link: null,
                    description: null,
                    image: null,
                    file: files[i],
                    playlist_id: null,
                    genre_id: null
                }
            }

            if(existing_files) {
                context.commit('SET_FILES', existing_files.concat(_files));
            } else {
                context.commit('SET_FILES', _files);
            }
        },
        UPLOAD_FILE: (context, payload) => {
            const config = {
                onUploadProgress: function(e) {
                    context.commit('SET_FILE_UPLOAD_PROGRESS', Math.round((e.loaded * 100) / e.total));
                }
            };

            axios.post('/api/track', payload.data, config).then(res => {
                context.commit('DELETE_FILE', payload.key);
                context.dispatch('GET_AVAILABLE_DURATION');
            }).catch(err => {
                console.log(err.response);
                context.commit('SET_FILE_UPLOAD_PROGRESS', 0);
                throw new Error('Что-то пошло не так при загрузке аудиофайла ('+err.response.status+')');
            });
        },
        UPLOAD_PLAYLIST_WITH_FILES: async (context, payload) => {
            try {
                const playlist_response = await axios.post('/api/playlist', payload);

                for(const file of context.getters.FILES) {
                    let form_data = new FormData();

                    file.playlist_id = playlist_response.data.id;
                    payload.has('image') ? file.image = payload.get('image'): file.image = null;
                    payload.has('genre_id') ? file.genre_id = payload.get('genre_id'): file.genre_id = null;

                    for(const prop in file) {
                        if(file[prop]) {
                            form_data.set(prop, file[prop]);
                        }
                    }

                    await axios.post('/api/track', form_data);
                }

                context.commit('SET_FILES', null);
            } catch (error) {
                console.log(error.response);
                throw new Error('Что-то пошло не так при загрузке плейлиста с файлами ('+error.response.status+')');
            }
        },
        CANCEL_FILE: (context, payload) => {
            context.commit('DELETE_FILE', payload);
        },
        CANCEL_ALL_FILES: (context) => {
            context.commit('SET_FILES', null);
        },
        GET_AVAILABLE_DURATION: (context) => {
            axios.get('/api/user/me/duration').then(res => {
                context.commit('SET_AVAILABLE_DURATION', Math.floor(res.data.duration / 60));
            });
        },
        GET_GENRES: (context) => {
            axios.get('/api/genre').then(res => {
                context.commit('SET_GENRES', res.data);
            }).catch(err => {
                console.log(err.response);
                throw new Error('Что-то пошло не так при попытке получить жанры ('+err.response.status+')');
            });
        },
        GET_PLAYLIST_TYPES: (context) => {
            axios.get('/api/playlist_type').then(res => {
                context.commit('SET_PLAYLIST_TYPES', res.data);
            }).catch(err => {
                console.log(err.response);
                throw new Error('Что-то пошло не так при попытке получить типы плейлистов ('+err.response.status+')');
            });
        },
        GET_PROFILE_TRACKS: (context, payload) => {
            axios.get(`/api/user/${payload}/track`).then(res => {
                context.commit('SET_PROFILE_TRACKS', res.data.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить треки профиля ('+error.response.status+')');
            });
        },
        GET_PROFILE_ALBUMS: (context, payload) => {
            axios.get(`/api/user/${payload}/playlist/album`).then(res => {
                context.commit('SET_PROFILE_ALBUMS', res.data.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить альбомы профиля ('+error.response.status+')');
            });
        },
        GET_PROFILE_PLAYLISTS: (context, payload) => {
            axios.get(`/api/user/${payload}/playlist/playlist`).then(res => {
                context.commit('SET_PROFILE_PLAYLISTS', res.data.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить плейлисты профиля ('+error.response.status+')');
            });
        },
        GET_PROFILE_PHOTOS: (context, payload) => {
            axios.get(`/api/user/${payload}/photo`).then(res => {
                context.commit('SET_PROFILE_PHOTOS', res.data.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить фото для профиля ('+error.response.status+')');
            });
        },
        UPLOAD_PROFILE_PHOTO: (context, payload) => {
            axios.post('/api/user/me/photo', payload.data).then(res => {
                context.dispatch('GET_PROFILE_PHOTOS', payload.link);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке загрузить фото для профиля ('+error.response.status+')');
            });
        },
        GET_PROFILE_LAST_UPLOADED_TRACKS: (context, payload) => {
            axios.get(`/api/user/${payload}/track`).then(res => {
                context.commit('SET_PROFILE_LAST_UPLOADED_TRACKS', res.data.data.splice(0, 5));
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить треки профиля ('+error.response.status+')');
            });
        },
        GET_PROFILE_POSTS: (context, payload) => {
            axios.get(`/api/user/${payload}/post`).then(res => {
                context.commit('SET_PROFILE_POSTS', res.data.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить посты профиля ('+error.response.status+')');
            });
        },
        CREATE_PROFILE_POST: (context, payload) => {
            axios.post(`/api/user/${payload.link}/post`, payload.data).then(res => {
                context.dispatch('GET_PROFILE_POSTS', payload.link);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке оставить пост для профиля ('+error.response.status+')');
            });
        },
        GET_INTERACTION_PROFILE: (context, payload) => {
            context.dispatch('CHECK_THE_TOKEN');

            if(context.getters.TOKEN_HAS_EXPIRED) {
                context.commit('SET_TOKEN_HAS_EXPIRED', false);
                return true;
            }

            axios.get(`/api/user/${payload}/profile`).then(res => {
                context.commit('SET_INTERACTION_PROFILE', res.data);
            }).catch(err => {
                if(err.response.status === 404) {
                    router.push({name: 'not-found'});
                }
                throw new Error('Что-то пошло не так при попытке получить данные о профиле ('+err.response.status+')');
            });
        },
        GET_PROFILE_FOLLOWERS: (context, payload) => {
            context.dispatch('CHECK_THE_TOKEN');

            if(context.getters.TOKEN_HAS_EXPIRED) {
                context.commit('SET_TOKEN_HAS_EXPIRED', false);
                return true;
            }

            axios.get(`/api/user/${payload}/follower`).then(res => {
                context.commit('SET_PROFILE_FOLLOWERS', res.data.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить подписчиков профиля ('+error.response.status+')');
            });
        },
        GET_PROFILE_FOLLOWINGS: (context, payload) => {
            context.dispatch('CHECK_THE_TOKEN');

            if(context.getters.TOKEN_HAS_EXPIRED) {
                context.commit('SET_TOKEN_HAS_EXPIRED', false);
                return true;
            }

            axios.get(`/api/user/${payload}/following`).then(res => {
                context.commit('SET_PROFILE_FOLLOWINGS', res.data.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить подписок профиля ('+error.response.status+')');
            });
        },
        GET_SETTINGS: (context) => {
            context.dispatch('CHECK_THE_TOKEN');

            if(context.getters.TOKEN_HAS_EXPIRED) {
                context.commit('SET_TOKEN_HAS_EXPIRED', false);
                return true;
            }

            axios.get('/api/user/me/setting').then(res => {
                context.commit('SET_SETTINGS', res.data);
            })
        },
        UPDATE_SETTINGS: (context, payload) => {
            context.dispatch('CHECK_THE_TOKEN');

            if(context.getters.TOKEN_HAS_EXPIRED) {
                context.commit('SET_TOKEN_HAS_EXPIRED', false);
                return true;
            }

            axios.put('/api/user/me/setting', payload).then(res => {
                context.commit('SET_SETTINGS', res.data);
            }).catch(error => {
                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке сохранить настройки ('+error.response.status+')');
            });
        },
        GET_TRACK: (context, payload) => {
            axios.get(`/api/track/${payload}`).then(res => {
                context.commit('SET_TRACK', res.data);
            }).catch(error => {
                if(error.response.status === 404) {
                    router.push({name:'not-found'});
                }

                console.log(error.response);
                throw new Error('Что-то пошло не так при попытке получить трек ('+error.response.status+')');
            });
        },
        LIKE_TRACK: (context, payload) => {
            axios.get(`/api/track/${payload}/like`).then(res => {
                context.state.track.likes_count++;
                context.state.track.liked = true;
            }).catch(error => {

            });
        },
        DELETE_TRACK_LIKE: (context, payload) => {
            axios.delete(`/api/track/${payload}/like`).then(res => {
                context.state.track.likes_count--;
                context.state.track.liked = false;
            }).catch(error => {

            });
        },
        GET_PLAYLIST: (context, payload) => {
            axios.get(`/api/playlist/${payload}`).then(res => {
                console.log(res.data);
                context.commit('SET_PLAYLIST', res.data);
            }).catch(error => {
                if(error.response.status === 404) {
                    router.push({name:'not-found'});
                }
            });
        },
        LIKE_PLAYLIST: (context, payload) => {
            axios.get(`/api/playlist/${payload}/like`).then(res => {
                context.state.playlist.likes_count++;
                context.state.playlist.liked = true;
            }).catch(error => {

            });
        },
        DELETE_PLAYLIST_LIKE: (context, payload) => {
            axios.delete(`/api/playlist/${payload}/like`).then(res => {
                context.state.playlist.likes_count--;
                context.state.playlist.liked = false;
            }).catch(error => {

            });
        },
        GET_TRACK_COMMENTS: (context, payload) => {
            axios.get(`/api/track/${payload}/comment`).then(res => {
                context.commit('SET_TRACK_COMMENTS', res.data.data);
            }).catch(error => {

            });
        }
    }
};