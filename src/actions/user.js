import axios from 'axios';

import * as eventActions from './event';

export const
    GET_TOKEN = 'GET_TOKEN',
    GET_TOKEN_SUCCESS = 'GET_TOKEN_SUCCESS',
    GET_TOKEN_ERROR = 'GET_TOKEN_ERROR',
    GET_USER_SUCCESS = 'GET_USER_SUCCESS',
    GET_USER_ERROR = 'GET_USER_ERROR',
    DECONNECT_USER = 'DECONNECT_USER',
    GET_USER_EVENTS_SUCCESS = 'GET_USER_EVENTS_SUCCESS',
    GET_USER_EVENTS_ERROR = 'GET_USER_EVENTS_ERROR',
    GET_USERS_SUCCESS = 'GET_USERS_SUCCESS',
    GET_USERS_ERROR = 'GET_USERS_ERROR',
    ADD_OR_STORE_USER = 'ADD_OR_STORE_USER',
    ADD_OR_STORE_USER_SUCCESS = 'ADD_OR_STORE_USER_SUCCESS',
    ADD_OR_STORE_USER_ERROR = 'ADD_OR_STORE_USER_ERROR',
    GET_JURY = 'GET_JURY',
    GET_JURY_SUCCESS = 'GET_JURY_SUCCESS',
    GET_JURY_ERROR = 'GET_JURY_ERROR',
    UPDATE_JURY_SUCCESS = 'UPDATE_JURY_SUCCESS',
    UPDATE_JURY_ERROR = 'UPDATE_JURY_ERROR',
    GET_MEETINGS_ERROR = 'GET_MEETINGS_ERROR',
    GET_MEETINGS_SUCCESS = 'GET_MEETINGS_SUCCESS';

const ROOT_URL = 'http://jiri-api.anne-remacle.be/api';

export function userConnect( email, password ) {
    const getTokenRequest = axios.get( `${ROOT_URL}/user/authenticate?email=${email}&password=${password}` );

    return (dispatch) => {
        dispatch({
            type: GET_TOKEN,
            loginPending: true,
        })
        getTokenRequest.then( (response) => {
            dispatch({
                type: GET_TOKEN_SUCCESS,
                token: response.data.token
            })

            dispatch( getUser( response.data.token ) )
        } ).catch( (error) => {
            dispatch({
                type: GET_TOKEN_ERROR,
                error: error.response.data.error
            })
        } )
    };
}

export function getUser(token) {
    const request = axios.get( `${ROOT_URL}/user/getAuthenticatedUser?token=${token}` );

    return (dispatch) => {
        request.then( ({data}) => {
            dispatch({
                type: GET_USER_SUCCESS,
                payload: data,
                loginPending: false
            });
        } ).catch( (error) => {
            dispatch({
                type: GET_USER_ERROR,
                error: error
            })
        } );
    }
}

export function userLogout() {
    return ( dispatch ) => {
        dispatch({
            type: DECONNECT_USER
        })
    }
}

export function getUserEvents(user_id){
    const request = axios.get(`${ROOT_URL}/user/${user_id}/events`);

    return (dispatch) => {
        request.then(({data}) => {
            dispatch({
                type: GET_USER_EVENTS_SUCCESS,
                events: data,
            })
        }).catch( (error) => {
            dispatch({
                type: GET_USER_EVENTS_ERROR,
                error: error
            })
        })
    }
}

export function getJurys() {
    const request = axios.get(`${ROOT_URL}/user`);

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: GET_USERS_SUCCESS,
                users: response.data
            })
        } ).catch( (errors) => {
            dispatch({
                type: GET_USERS_ERROR,
                errors: errors
            })
        } )
    }
}

export function addOrStore(data) {
    const request = axios.post(`${ROOT_URL}/user/addOrStore`, data, {headers: { 'content-type': 'multipart/form-data' }});

    return (dispatch) => {
        dispatch({
            type: ADD_OR_STORE_USER,
            pending: true,
        })

        request.then( (response) => {
            dispatch({
                type: ADD_OR_STORE_USER_SUCCESS,
                pending: false,
            })
            dispatch(eventActions.getEventJurys(data.get("event_id")))
        } ).catch( (errors) => {
            dispatch({
                type: ADD_OR_STORE_USER_ERROR,
                errors: errors,
                pending: false
            })
        })
    };
}

export function getJury(user_id) {
    const request = axios.get( `${ROOT_URL}/user/${user_id}`);
    return (dispatch) => {
        dispatch({
            type: GET_JURY,
            pending: true,
        })
        request.then( (response) => {
            dispatch({
                type: GET_JURY_SUCCESS,
                jury: response.data,
                pending: false,
            })
        } ).catch( (errors) => {
            dispatch({
                type: GET_JURY_ERROR,
                errors: errors,
                pending: false
            })
        })
    };
}

export function editJury(data, user_id){
    const request = axios.post(`${ROOT_URL}/user/${user_id}/update`, data, {headers: { 'content-type': 'multipart/form-data' }});

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: UPDATE_JURY_SUCCESS,
            })
        } ).catch( (errors) => {
            dispatch({
                type: UPDATE_JURY_ERROR,
                error: errors,
            })
        })
    }
}

export function getMeetings(event_id, user_id){
    const request = axios.get(`${ROOT_URL}/user/${user_id}/meetings/${event_id}`);

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: GET_MEETINGS_SUCCESS,
                meetings: response.data
            })
        }).catch( (errors) => {
            dispatch({
                type: GET_MEETINGS_ERROR,
                error: errors
            })
        })
    }
}
