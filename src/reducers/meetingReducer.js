import {
    CREATE_MEETING_SUCCESS,
    CREATE_MEETING_ERROR,
    GET_MEETING_ERROR,
    GET_MEETING_SUCCESS,
    UPDATE_SCORES_SUCCESS,
    UPDATE_SCORES_ERROR
} from '../actions/meeting';

const INITIAL_STATE = {
    error: null,
    meeting: null,
}

export default function(state = INITIAL_STATE, action) {
    switch (action.type) {
        case CREATE_MEETING_SUCCESS:
            return {
                ...state,
                meeting: action.meeting
            }
        case CREATE_MEETING_ERROR:
            return {
                ...state,
                error: action.errors
            }
        case GET_MEETING_SUCCESS:
            return {
                ...state,
                meeting: action.meeting
            }
        case GET_MEETING_ERROR:
            return {
                ...state,
                error: action.errors
            }
        case UPDATE_SCORES_SUCCESS:
            return {
                ...state,
            }
        case UPDATE_SCORES_ERROR:
            return {
                ...state,
                error: action.errors
            }
        default:
            return state;
    }
}
