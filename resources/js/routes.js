import Home from "./components/Home";
import Stream from "./components/Stream";
import Profile from "./components/Profile";
import Upload from "./components/Upload";
import All from "./components/profile/publications/All";
import Tracks from "./components/profile/publications/Tracks";
import Albums from "./components/profile/publications/Albums";
import Publications from "./components/profile/Publications";
import NotFound from "./components/NotFound";
import Playlists from "./components/profile/publications/Playlists";
import Interaction from "./components/profile/Interaction";
import Followers from "./components/profile/interaction/Followers";
import Followings from "./components/profile/interaction/Followings";
import Settings from "./components/Settings";
import PasswordReset from "./components/auth/PasswordReset";
import BigTrack from "./components/BigTrack";
import BigAlbum from "./components/BigAlbum";
import BigPlaylist from "./components/BigPlaylist";

export const routes = [
    {
        path: '*',
        redirect: '/404'
    },
    {
        path: '/404',
        component: NotFound,
        name: 'not-found'
    },
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/stream',
        component: Stream
    },
    {
        path: '/profile/:link',
        component: Profile,
        children: [
            {
                path: '',
                component: Publications,
                children: [
                    {
                        path: '',
                        component: All,
                        name: 'publications-all'
                    },
                    {
                        path: 'tracks',
                        component: Tracks,
                        name: 'publications-tracks'
                    },
                    {
                        path: 'albums',
                        component: Albums,
                        name: 'publications-albums'
                    },
                    {
                        path: 'playlists',
                        component: Playlists,
                        name: 'publications-playlists'
                    }
                ]
            }
        ]
    },
    {
        path: '/profile/:link',
        component: Interaction,
        children: [
            {
                path: '/profile/:link/followers',
                component: Followers,
                name: 'interaction-followers'
            },
            {
                path: '/profile/:link/followings',
                component: Followings,
                name: 'interaction-followings'
            }
        ]
    },
    {
        path: '/settings',
        component: Settings,
        name: 'settings',
        meta: { requires_auth: true }
    },
    {
        path: '/upload',
        component: Upload,
        meta: { requires_auth: true }
    },
    {
        path: '/password_reset/:token',
        component: PasswordReset
    },
    {
        path: '/tracks/:link',
        component: BigTrack
    },
    {
        path: '/playlists/:link',
        component: BigPlaylist
    }
];