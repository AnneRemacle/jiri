import {
    CREATE_EVENT,
    CREATE_EVENT_SUCCESS,
    CREATE_EVENT_ERROR,
    GET_EVENT_ERROR,
    GET_EVENT_SUCCESS,
    UPDATE_EVENT_ERROR,
    UPDATE_EVENT_SUCCESS,
    DELETE_EVENT_ERROR,
    DELETE_EVENT_SUCCESS,
    GET_EVENT_PROJECTS_SUCCESS,
    GET_EVENT_PROJECTS_ERROR,
    REMOVE_PROJECT_ERROR,
    REMOVE_PROJECT_SUCCESS,
    GET_EVENT_STUDENTS_SUCCESS,
    GET_EVENT_STUDENTS_ERROR,
    REMOVE_STUDENT_ERROR,
    REMOVE_STUDENT_SUCCESS,
    GET_EVENT_JURYS_SUCCESS,
    GET_EVENT_JURYS_ERROR,
    REMOVE_JURY_ERROR,
    REMOVE_JURY_SUCCESS,
    GET_CURRENT_EVENT,
    GET_CURRENT_EVENT_SUCCESS,
    GET_CURRENT_EVENT_ERROR

} from '../actions/event';

const INITIAL_STATE = {
    createEventPending: false,
    createEventErrors: null,
    event: null,
    errors: null,
    project: null,
    projects: null,
    students: null,
    student: null,
    jurys: null,
    jury: null,
    currentEvent: null,
    getCurrentEventPending: false,
    students: null,
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
        case GET_EVENT_PROJECTS_SUCCESS:
            return {
                ...state,
                projects: action.projects
            }
        case GET_EVENT_PROJECTS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case REMOVE_PROJECT_SUCCESS:
            return {
                ...state,
                project: null
            }
        case REMOVE_PROJECT_ERROR:
            return {
                ...state,
                error: action.error
            }
        case GET_EVENT_STUDENTS_SUCCESS:
            return {
                ...state,
                students: action.students
            }
        case GET_EVENT_STUDENTS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case REMOVE_STUDENT_SUCCESS:
            return {
                ...state,
                student: null
            }
        case REMOVE_STUDENT_ERROR:
            return {
                ...state,
                error: action.error
            }
        case GET_EVENT_JURYS_SUCCESS:
            return {
                ...state,
                jurys: action.jurys
            }
        case GET_EVENT_JURYS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case REMOVE_JURY_SUCCESS:
            return {
                ...state,
                jury: null
            }
        case REMOVE_JURY_ERROR:
            return {
                ...state,
                error: action.error
            }
        case GET_CURRENT_EVENT:
            return {
                ...state,
                getCurrentEventPending: action.pending,
            }
        case GET_CURRENT_EVENT_SUCCESS:
            return {
                ...state,
                currentEvent: action.currentEvent,
                getCurrentEventPending: action.pending,
            }
        case GET_CURRENT_EVENT_ERROR:
            return {
                ...state,
                error: action.error,
                getCurrentEventPending: action.pending,
            }
        default:
            return state;
    }
}
