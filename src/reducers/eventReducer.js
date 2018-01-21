import {
    CREATE_EVENT,
    CREATE_EVENT_SUCCESS,
    CREATE_EVENT_ERROR,
    GET_EVENT_ERROR,
    GET_EVENT_SUCCESS,
    UPDATE_EVENT_ERROR,
    UPDATE_EVENT_SUCCESS,
    DELETE_EVENT_ERROR,
    DELETE_EVENT_SUCCESS
} from '../actions/event';

const INITIAL_STATE = {
    createEventPending: false,
    createEventErrors: null,
    event: null,
    errors: null
}

export default function( state = INITIAL_STATE, action ) {
    switch (action.type) {
        case CREATE_EVENT:
            return {
                ...state,
                createEventPending: action.createEventPending
            };
        case CREATE_EVENT_SUCCESS:
            return {
                ...state,
                createEventPending: action.createEventPending,
                event: action.event,
                errors: false,
            }
        case CREATE_EVENT_ERROR:
            return {
                ...state,
                createEventPending: action.createEventPending,
                errors: true
            }
        case GET_EVENT_SUCCESS:
            return {
                ...state,
                event: action.event
            }
        case GET_EVENT_ERROR:
            return {
                ...state,
                error: action.error
            }
        case UPDATE_EVENT_SUCCESS:
            return state
        case UPDATE_EVENT_ERROR:
            return {
                ...state,
                error: action.error
            }
        case DELETE_EVENT_SUCCESS:
            return {
                ...state,
                event: null,
            }
        case DELETE_EVENT_ERROR:
            return {
                ...state,
                error: action.error
            }
        default:
            return state;
    }
}
