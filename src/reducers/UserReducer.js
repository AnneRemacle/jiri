import {
    GET_TOKEN,
    GET_TOKEN_SUCCESS,
    GET_TOKEN_ERROR,
    GET_USER_SUCCESS,
    GET_USER_ERROR,
    DECONNECT_USER,
    GET_USER_EVENTS_ERROR,
    GET_USER_EVENTS_SUCCESS,
    GET_USERS_SUCCESS,
    GET_USERS_ERROR,
    ADD_OR_STORE_USER,
    ADD_OR_STORE_USER_SUCCESS,
    ADD_OR_STORE_USER_ERROR,
    GET_JURY,
    GET_JURY_SUCCESS,
    GET_JURY_ERROR,
    UPDATE_JURY_SUCCESS,
    UPDATE_JURY_ERROR,
    GET_MEETINGS_SUCCESS,
    GET_MEETINGS_ERROR,
} from '../actions/user';

const INITIAL_STATE = {
    token: null,
    error: null,
    user: null,
    loginPending: false,
    events: null,
    users: null,
    addOrStorePending: false,
    jury: null,
    meetings: null,
    implementations: null,
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
        case GET_USERS_SUCCESS:
            return {
                ...state,
                users: action.users
            }
        case GET_USERS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case ADD_OR_STORE_USER:
            return {
                ...state,
                addOrStorePending: action.pending
            }
        case ADD_OR_STORE_USER_SUCCESS:
            return {
                ...state,
                addOrStorePending: action.pending
            }
        case ADD_OR_STORE_USER_ERROR:
            return {
                ...state,
                error: action.error,
                addOrStorePending: action.pending
            }
        case GET_JURY:
            return {
                ...state,
                getPending: true,
            }
        case GET_JURY_SUCCESS:
            return {
                ...state,
                jury: action.jury,
                getPending: false,
            }
        case GET_JURY_ERROR:
            return {
                ...state,
                error: action.error,
                getPending: false,
            }
        case UPDATE_JURY_SUCCESS:
            return state
        case UPDATE_JURY_ERROR:
            return {
                ...state,
                error: action.error
            }
        case GET_MEETINGS_SUCCESS:
            return {
                ...state,
                meetings: action.meetings
            }
        case GET_MEETINGS_ERROR:
            return {
                ...state,
                error: action.error
            }
        default:
            return state;

    }
}
