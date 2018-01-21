import {
    GET_PROJECTS_ERROR,
    GET_PROJECTS_SUCCESS,
    ADD_OR_STORE_PROJECTS_SUCCESS,
    ADD_OR_STORE_PROJECTS_ERROR,
    GET_PROJECT_ERROR,
    GET_PROJECT_SUCCESS,
    UPDATE_PROJECT_ERROR,
    UPDATE_PROJECT_SUCCESS
} from '../actions/project';

const INITIAL_STATE = {
    error: null,
    projects: null,
    project: null
};

export default function( state = INITIAL_STATE, action ) {
    switch (action.type) {
        case GET_PROJECTS_SUCCESS:
            return {
                ...state,
                projects: action.projects
            };
        case GET_PROJECTS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case ADD_OR_STORE_PROJECTS_SUCCESS:
            return state
        case ADD_OR_STORE_PROJECTS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case UPDATE_PROJECT_SUCCESS:
            return state
        case UPDATE_PROJECT_ERROR:
            return {
                ...state,
                error: action.error
            }
        case GET_PROJECT_SUCCESS:
            return {
                ...state,
                project: action.project
            };
        case GET_PROJECT_ERROR:
            return {
                ...state,
                error: action.error
            }
        default:
            return state;
    }
}
