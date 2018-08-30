import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import Spinner from "./Spinner";

import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';
import * as studentActions from '../actions/student';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    student: state.studentSelectors.student,
    getStudentPending: state.studentSelectors.getPending,
    projects: state.eventSelectors.projects,
    implementations: state.studentSelectors.implementations,
});

const mapActionsToProps = dispatch => ({
    getStudent(student_id){
        dispatch(studentActions.getStudent(student_id))
    },
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    getEvent(event_id){
        dispatch(eventActions.getEvent(event_id));
    },
    getEventProjects(event_id){
        dispatch(eventActions.getEventProjects(event_id))
    },
    updateImplementations(data, student_id, event_id){
        dispatch(studentActions.updateImplementations(data, student_id, event_id))
    },
    getImplementationsForEvent(student_id, event_id){
        dispatch(studentActions.getImplementationsForEvent(student_id, event_id))
    },
})

@connect(mapStateToProps, mapActionsToProps)
export default class ManageStudent extends Component {
    constructor(oProps) {
        super(oProps);

        this.state = {
            projectsUrls: {}
        }
    }

    componentWillMount(){
        this.props.getStudent(this.props.params.student_id);
        this.props.getEvent(this.props.params.event_id);
        this.props.getEventProjects(this.props.params.event_id);
        this.props.getImplementationsForEvent(this.props.params.student_id, this.props.params.event_id);

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        let projects = {},
            results = {};

        if(oNextProps.implementations && oNextProps.implementations != this.props.implementations){
            Object.entries(oNextProps.implementations).map( implementation =>
                results[implementation[1].project_id] = {
                    "githubUrl": implementation[1].url_repo,
                    "siteUrl": implementation[1].url_project,
                    "weight": implementation[1].weight,
                }
            );

            this.setState({
                projectsUrls: {
                    ...results
                }
            })
        }
    }

    handleSubmit(e){
        e.preventDefault();
        let data = this.state.projectsUrls;

        this.props.updateImplementations(data, this.props.student.id, this.props.event.id);
    }

    handleGithubUrlChange(e){
        let results = {};

        results[e.target.dataset.project] = {
            ...this.state.projectsUrls[e.target.dataset.project],
            githubUrl: e.target.value
        };

        this.setState({
            projectsUrls : {
                ...this.state.projectsUrls,
                ...results
            }
        })
    }

    handleSiteUrlChange(e){
        let results = {};

        results[e.target.dataset.project] = {
            ...this.state.projectsUrls[e.target.dataset.project],
            siteUrl: e.target.value
        };

        this.setState({
            projectsUrls : {
                ...this.state.projectsUrls,
                ...results
            }
        })
    }

    handleWeightChange(e){
        let results = {};

        results[e.target.dataset.project] = {
            ...this.state.projectsUrls[e.target.dataset.project],
            weight: e.target.value
        }

        this.setState({
            projectsUrls: {
                ...this.state.projectsUrls,
                ...results
            }
        })
    }

    renderProjectsForm(){
        return (
            this.props.projects.map( project =>
                <section className="form-item item" key={project.id}>
                    <h3 className="item__name">{project.name}</h3>
                    <div className="form-group">
                        <label htmlFor="github" className="form__label">Repo Github</label>
                        <input value={this.state.projectsUrls[project.id] ? this.state.projectsUrls[project.id].githubUrl : ""} type="text" name="github" id="github" className="form__input" data-project={project.id} onChange={this.handleGithubUrlChange.bind(this)}/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="site" className="form__label">Url Site</label>
                        <input value={this.state.projectsUrls[project.id] ? this.state.projectsUrls[project.id].siteUrl : ""} type="text" name="site" id="site" className="form__input" data-project={project.id} onChange={this.handleSiteUrlChange.bind(this)}/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="weight" className="form__label">Pondération</label>
                        <input value={this.state.projectsUrls[project.id] ? this.state.projectsUrls[project.id].weight : ""} type="number" name="weight" id="weight" className="form__input" data-project={project.id} onChange={this.handleWeightChange.bind(this)}/>
                    </div>
                </section>
            )
        )
    }

    render() {
        if(this.props.getStudentPending){
            return (
                <div className="regular-spinner">
                    <Spinner message={'Chargement'} />
                </div>
            );
        }

        return(
            <section className="section">
                <Link className='back' to={`/event/${this.props.params.event_id}/manageStudents`}><i className="fa fa-caret-left"></i>Retour</Link>
                {
                    this.props.student
                    ? <div><h2 className="section__title">{this.props.student.name}</h2><p>Pour chaque projet de l'étudiant, encodez les urls des repos Github et des sites web.</p></div>
                    : <p>Pas d'étudiant</p>
                }
                <form className="form form-regular" onSubmit={this.handleSubmit.bind(this)}>
                    {
                        this.props.projects
                        ? this.renderProjectsForm()
                        : <p>Pas de projet</p>
                    }
                    <div className="form-group">
                        <input type="submit" className="form__button button" value='Enregistrer'/>
                    </div>
                </form>
            </section>
        );
    }
}
