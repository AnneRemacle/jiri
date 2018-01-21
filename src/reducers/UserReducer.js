import {
    GET_TOKEN,
    GET_TOKEN_SUCCESS,
    GET_TOKEN_ERROR,
    GET_USER_SUCCESS,
    GET_USER_ERROR,
    DECONNECT_USER,
    GET_USER_EVENTS_ERROR,
    GET_USER_EVENTS_SUCCESS
} from '../actions/user';

const INITIAL_STATE = {
    token: null,
    error: null,
    user: null,
    loginPending: false,
    events: null,
};

export default function( state = INITIAL_STATE, action ) {
    let errorMsg = "";

    switch (action.type) {
        case GET_TOKEN:
            return {
                ...state,
                loginPending: action.loginPending
            };
        case GET_TOKEN_SUCCESS:
            sessionStorage.setItem( 'token', action.token )

            return {
                ... state,
                token: action.token
            };
        case GET_TOKEN_ERROR:
            if (action.payload === 'invalid_credentials') {
                errorMsg = "Le mot de passe et l'email ne correspondent pas à nos données"
            }

            return {
                ...state,
                error: errorMsg
            }
        case GET_USER_SUCCESS:
            return {
                ...state,
                user: action.payload.result,
                loginPending: action.loginPending
            }
        case GET_USER_ERROR:
            return state;
        case DECONNECT_USER:
            sessionStorage.removeItem("token");

            return {
                ...state,
                user: null
            }
        case GET_USER_EVENTS_SUCCESS:
            return {
                ...state,
                events: action.events
            }
        case GET_USER_EVENTS_ERROR:
            return {
                ...state,
                error: action.error
            }
        default:
            return state;

    }
}
