import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import Spinner from "./Spinner";

import * as projectActions from '../actions/project';
import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';

const mapStateToProps = state => ({
    allProjects: state.projectSelectors.projects,
    projectError: state.projectSelectors.error,
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    eventProjects: state.eventSelectors.projects,
    project: state.eventSelectors.project
});

const mapActionsToProps = dispatch => ({
    getProjects(){
        dispatch(projectActions.getProjects())
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
    addOrStoreProject(name, description, event_id, user_id){
        dispatch(projectActions.addOrStore(name, description, event_id, user_id))
    },
    removeProject( event_id, project_id ) {
        dispatch(eventActions.removeProject(event_id, project_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class AddProject extends Component {
    constructor(oProps) {
        super(oProps);

        this.state= {
            name: "",
            description: "",
        }
    }

    componentWillMount(){
        this.props.getProjects();
        this.props.getEvent(this.props.params.id);
        this.props.getEventProjects(this.props.params.id);

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.addOrStoreProject(this.state.name, this.state.description, this.props.event.id, this.props.user.id);
        this.setState({
            name:"",
            description:""
        })
    }

    handleProjectNameChange(e) {
        this.setState({
            name: e.target.value
        })
    }

    handleDescriptionChange(e) {
        this.setState({
            description: e.target.value
        })
    }

    handleDeleteClick(e) {
        e.preventDefault();
        this.props.removeProject( this.props.event.id, e.target.dataset.project )
    }

    render() {
        if (!this.props.event) {
            return (
                <div className="regular-spinner">
                    <Spinner message={'Chargement'} />
                </div>
            );
        }
        return(
            <section className="section">
                <Link  to={ `showEvent/${this.props.params.id}` } className="back"><i className="fa fa-caret-left"></i>Retour à l'événement</Link>

                <h2 className="section__title">Ajouter un projet à {this.props.event.course_name}</h2>
                <p>Ajoutez un projet à évaluer lors de l'examen.</p>

                <form className="form form-regular" onSubmit={this.handleSubmit.bind(this)}>
                    <div className="form-group">
                        <label htmlFor="name" className="form__label">Nom du projet</label>
                        <input value={this.state.name} list="projects" type="text" name="name" id="name" placeholder="CV à la manière de…" className="form__input" onChange={this.handleProjectNameChange.bind(this)}/>
                        <datalist id='projects'>
                            {
                                this.props.allProjects
                                ? this.props.allProjects.map( project => <option key={project.id} value={project.name} />)
                                : ""
                            }
                        </datalist>
                    </div>
                    <div className="form-group">
                        <label htmlFor="description" className="form__label">Description</label>
                        <textarea value={this.state.description} name="description" id="description" className="form__area" onChange={this.handleDescriptionChange.bind(this)}>
                        </textarea>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button button" value='Ajouter'/>
                    </div>
                </form>
                <section className="sub-section">
                    <h3 className="sub-section__title">Projet(s) ajoutés à {this.props.event.course_name}</h3>
                    {
                        this.props.eventProjects
                        ? this.props.eventProjects.map( project =>
                            <div className="item" key={project.id}>
                                <span className="item__name">{project.name}</span>
                                <Link className="buttons edit-button" to={`project/${project.id}/edit`}><i className="fa fa-pencil"></i></Link>
                                <a className="buttons delete-button" href="#" onClick={this.handleDeleteClick.bind(this)} data-project={project.id}><i className="fa fa-trash" data-project={project.id}></i></a>
                            </div>
                        )
                        : <p>Il n'y a pas encore de projets pour cet événement</p>
                    }
                </section>

            </section>
        );
    }
}
