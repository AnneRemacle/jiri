import axios from 'axios';

export const
    GET_TOKEN = 'GET_TOKEN',
    GET_TOKEN_SUCCESS = 'GET_TOKEN_SUCCESS',
    GET_TOKEN_ERROR = 'GET_TOKEN_ERROR',
    GET_USER_SUCCESS = 'GET_USER_SUCCESS',
    GET_USER_ERROR = 'GET_USER_ERROR',
    DECONNECT_USER = 'DECONNECT_USER';

const ROOT_URL = 'http://localhost:8000/api';

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
